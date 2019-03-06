<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Exception\PrmException;
use App\Service\ParameterService;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;

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
        $formattedCaseDescription = '<strong>Account Name: </strong>' . $data['generalInfo']['accountName'] . "<br>\n";
        $formattedCaseDescription .= '<strong>Seller Center ID: </strong>' . $data['generalInfo']['sellerCenterId'] . "<br>\n";
        foreach ($enabledFields[$data['generalInfo']['reasons']] as $enabledField) {
            $fieldLabel = preg_split('/(?=[A-Z])/', $enabledField);
            $fieldLabel = implode(' ', $fieldLabel);
            $formattedCaseDescription .= '<strong>' . ucfirst($fieldLabel) . ': </strong>' . $data['additionalInfo'][$enabledField] . "<br>\n";
        }

        return $formattedCaseDescription;
    }

    protected function buildContactRequestBody(array $data, array $enabledFields, string $store, string $accountId): array
    {
        $caseDescription = $this->getFormattedCaseDescription($enabledFields, $data);

        return [
            ['name' => 'case[subject]', 'contents' => $data['generalInfo']['accountName']],
            ['name' => 'case[storeId]', 'contents' => $store],
            ['name' => 'case[source]', 'contents' => self::FORM_CASE_SOURCE_NAME],
            ['name' => 'case[contactId]', 'contents' => $data['generalInfo']['email']],
            ['name' => 'case[description]', 'contents' => $caseDescription],
            ['name' => 'case[reasonId]', 'contents' => $data['generalInfo']['reasons']],
            ['name' => 'case[relatedAccount]', 'contents' => $accountId],
        ];
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
