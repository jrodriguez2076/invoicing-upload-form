<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Exception\PrmException;
use App\Service\ParameterService;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PrmAdapter
{
    protected const FORM_CASE_SOURCE_NAME = 'web';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ParameterService
     */
    protected $parameterService;

    public function __construct(ClientInterface $client, string $clientId, string $clientSecret, LoggerInterface $logger, ParameterService $parameterService)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->logger = $logger;
        $this->parameterService = $parameterService;
    }

    public function createCase(array $data, array $enabledFields, string $store, string $accountId): void
    {
        $requestBody = $this->buildContactRequestBody($data, $enabledFields, $store, $accountId);

        try {
            $this->logger->info('Attempting to create case');
            $response = $this->client->request(
                'POST',
                '/api/rest/latest/cases',
                [
                    'headers' => $this->getWsseHeaders(),
                    'multipart' => $requestBody,
                ]
            );
        } catch (ClientException $exception) {
            $this->logger->error($exception->getMessage(), [
                'response' => [
                    'body' => $exception->getResponse()->getBody()->getContents(),
                ],
            ]);

            throw new PrmException($exception->getMessage());
        } catch (ServerException $exception) {
            $this->logger->error($exception->getMessage(), [
                'response' => [
                    'body' => $exception->getResponse()->getBody()->getContents(),
                ],
            ]);

            throw new PrmException($exception->getMessage());
        }

        if ($response->getStatusCode() != 201) {
            $this->logger->error('CASE_CREATE_ERROR', [
                'response' => [
                    'body' => $response->getBody()->getContents(),
                ],
            ]);

            throw new PrmException('CASE_CREATE_ERROR', 500);
        }

        $responseContent = $response->getBody()->getContents();
        $jsonResponseContent = json_decode($responseContent, true);

        if (!isset($jsonResponseContent['id'])) {
            throw new PrmException('CASE_CREATE_ERROR', 500);
        }

        $this->logger->info('Case created');
    }

    public function getReasons(string $storeCode): array
    {
        try {
            $response = $this->client->request('GET', '/api/rest/latest/reasons.json', [
                'headers' => $this->getWsseHeaders(),
                'query' => [
                    'store' => $storeCode,
                ],
            ]);
        } catch (ClientException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody(), true);
            $errorMessage = $responseBody['message'] ?? $exception->getMessage();
            throw new PrmException((string) $errorMessage);
        } catch (ServerException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody(), true);
            $errorMessage = $responseBody['message'] ?? '';
            throw new PrmException((string) $errorMessage);
        }

        $responseBody = json_decode((string) $response->getBody(), true);
        $reasons = [];
        $reasonsEnabledFields = [];

        foreach ($responseBody as $row) {
            $reasons[$row['category']][$row['name']] = $row['id'];

            if (!$row['contactFormFields']) {
                $reasonsEnabledFields[$row['id']] = $row['contactFormFields'];
                continue;
            }

            $reasonsEnabledFields[$row['id']] = explode(',', $row['contactFormFields']);
        }

        return ['reasons' => $reasons, 'reasonsEnabledFields' => $reasonsEnabledFields];
    }

    public function getGenericAccountId(string $storeCode): string
    {
        try {
            $response = $this->client->request('GET', '/api/rest/latest/accountemail', [
                'headers' => $this->getWsseHeaders(),
                'query' => [
                    'email' => $this->parameterService->getGenericAccountEmail($storeCode),
                ],
            ]);
        } catch (ClientException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody(), true);
            $errorMessage = $responseBody['message'] ?? $exception->getMessage();
            throw new PrmException((string) $errorMessage);
        } catch (ServerException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody(), true);
            $errorMessage = $responseBody['message'] ?? '';
            throw new PrmException((string) $errorMessage);
        }

        $responseBody = json_decode((string) $response->getBody(), true);
        $accountId = $responseBody['account']['id'];

        return (string) $accountId;
    }

    protected function getFormattedCaseDescription(array $enabledFields, array $data): string
    {
        $formattedCaseDescription = '<strong>Contact Name: </strong>' . $data['generalInfo']['contactFullName'] . "<br>\n";
        $formattedCaseDescription .= '<strong>Seller Center ID: </strong>' . $data['generalInfo']['sellerCenterId'] . "<br>\n";

        if (!$this->reasonHasEnabledFields($enabledFields, $data['generalInfo']['reasons'])) {
            $formattedCaseDescription .= '<strong>Reason: </strong>' . $data['additionalInfo']['reason'] . "<br>\n";

            return $formattedCaseDescription;
        }

        foreach ($enabledFields[$data['generalInfo']['reasons']] as $enabledField) {
            if (!array_key_exists($enabledField, $data['additionalInfo']) || !is_string($data['additionalInfo'][$enabledField])) {
                continue;
            }

            $fieldLabel = preg_split('/(?=[A-Z])/', $enabledField);
            $fieldLabel = implode(' ', $fieldLabel);
            $formattedCaseDescription .= '<strong>' . ucfirst($fieldLabel) . ': </strong>' . $data['additionalInfo'][$enabledField] . "<br>\n";
        }

        if ($data['additionalInfo']['reason'] && !in_array('reason', $enabledFields[$data['generalInfo']['reasons']])) {
            $formattedCaseDescription .= '<strong>Reason: </strong>' . $data['additionalInfo']['reason'] . "<br>\n";
        }

        return $formattedCaseDescription;
    }

    protected function buildFilesRequest(array $enabledFields, array $data): array
    {
        $filesRequestArray = [];

        if (!$this->reasonHasEnabledFields($enabledFields, $data['generalInfo']['reasons'])) {
            return $filesRequestArray;
        }

        foreach ($enabledFields[$data['generalInfo']['reasons']] as $enabledField) {
            if (!array_key_exists($enabledField, $data['additionalInfo']) || is_string($data['additionalInfo'][$enabledField])) {
                continue;
            }

            if (!is_array($data['additionalInfo'][$enabledField])) {
                $filesRequestArray[] = $data['additionalInfo'][$enabledField];
                continue;
            }

            foreach ($data['additionalInfo'][$enabledField] as $file) {
                $filesRequestArray[] = $file;
            }
        }

        return $filesRequestArray;
    }

    protected function buildContactRequestBody(array $data, array $enabledFields, string $store, string $accountId): array
    {
        $caseDescription = $this->getFormattedCaseDescription($enabledFields, $data);
        $filesArray = $this->buildFilesRequest($enabledFields, $data);

        $requestBody = [
            ['name' => 'case[subject]', 'contents' => $data['generalInfo']['sellerCenterId']],
            ['name' => 'case[storeId]', 'contents' => $store],
            ['name' => 'case[source]', 'contents' => self::FORM_CASE_SOURCE_NAME],
            ['name' => 'case[contactId]', 'contents' => $data['generalInfo']['email']],
            ['name' => 'case[description]', 'contents' => $caseDescription],
            ['name' => 'case[reasonId]', 'contents' => $data['generalInfo']['reasons']],
            ['name' => 'case[relatedAccount]', 'contents' => $accountId],
        ];

        if (!$this->reasonHasEnabledFields($enabledFields, $data['generalInfo']['reasons'])) {
            return $requestBody;
        }

        if (in_array('orderNumbers', $enabledFields[$data['generalInfo']['reasons']])) {
            $requestBody[] = ['name' => 'case[orderId]', 'contents' => $data['additionalInfo']['orderNumbers']];
        }

        if (!empty($filesArray)) {
            foreach ($filesArray as $index => $file) {
                $requestBody[] = $this->getMultipartRequestFile($file, $index);
            }
        }

        return $requestBody;
    }

    protected function reasonHasEnabledFields(array $enabledFields, string $reason): bool
    {
        return (bool) $enabledFields[$reason];
    }

    protected function getMultipartRequestFile(?UploadedFile $uploadedFile, int $index): array
    {
        if (!isset($uploadedFile)) {
            return [];
        }

        if ($uploadedFile instanceof UploadedFile) {
            $originalFileName = $uploadedFile->getClientOriginalName();
            $defaultFileName = sprintf('uploadedFile.%s', $uploadedFile->guessExtension());
            $uploadedFilePath = sprintf(
                '%s/%s%s',
                $uploadedFile->getPath(),
                $uploadedFile->getFilename(),
                $uploadedFile->getExtension()
            );

            $uploadedOpenedFile = fopen($uploadedFilePath, 'r');

            if (isset($uploadedOpenedFile)) {
                return [
                    'name' => sprintf('file[%s][content]', $index),
                    'contents' => $uploadedOpenedFile,
                    'filename' => $originalFileName ?? $defaultFileName,
                ];
            }
        }

        return [];
    }

    protected function getWsseHeaders(): array
    {
        $nonce = uniqid();
        $createdAt = date('c');
        $wsse = sprintf(
            'UsernameToken Username="%s", PasswordDigest="%s", Nonce="%s", Created="%s"',
            $this->clientId,
            base64_encode(sha1(base64_decode($nonce) . $createdAt . $this->clientSecret, true)),
            $nonce,
            $createdAt
        );

        return [
            'Authorization' => 'WSSE profile="UsernameToken"',
            'X-WSSE' => $wsse,
        ];
    }
}
