<?php

declare(strict_types=1);

namespace App\Adapter;

use DateTime;
use App\Exception\OroException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

    class OroAdapter
{
    /**
     * @var string|null
     */
    protected $accessToken;

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

    public function __construct(ClientInterface $client, string $clientId, string $clientSecret)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function sendFiles(array $data, string $contactId): void
    {
        $filesArray = $this->buildFilesRequest($data);

        if (!empty($filesArray)) {
            foreach ($filesArray as $file) {
                $requestBody = $this->buildUploadRequestBody($file, $contactId);

                try {
                    $response = $this->client->request(
                        'POST',
                        '/api/rest/latest/files',
                        [
                            'headers' => $this->getRequestHeaders($this->getAccessToken()),
                            'multipart' => $requestBody,
                        ]
                    );
                } catch (ClientException $exception) {

                    throw new OroException($exception->getMessage());
                } catch (ServerException $exception) {

                    throw new OroException($exception->getMessage());
                }

                if ($response->getStatusCode() != 201) {

                    throw new OroException('GENERAL_ERROR', 500);
                }
            }
        }
    }

    public function getContactIdByEmail(string $email): string
    {
        try {
            $response = $this->client->request('GET', '/api/rest/latest/emailcontact', [
                'headers' => $this->getRequestHeaders($this->getAccessToken()),
                'query' => [
                    'email' => $email,
                ],
            ]);
        } catch (BadResponseException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody(), true);
            $errorMessage = $responseBody['message'] ?? $exception->getMessage();

            throw new OroException((string) $errorMessage);
        } catch (ConnectException $exception) {
            throw new OroException($exception->getMessage());
        }

        $responseBody = json_decode((string) $response->getBody(), true);

        if (array_key_exists('error', $responseBody)) {
            throw new OroException('El email de contacto no se encuentra registrado.');
        }

        $contactId = $responseBody['contact']['id'];

        return (string) $contactId;
    }

    public function getAccessToken(): string
    {
        if (apcu_exists('accessToken')) {
            return apcu_fetch('accessToken');
        }

        return $this->accessToken ?? $this->createAccessToken();
    }

    protected function buildFilesRequest(array $data): array
    {
        $filesRequestArray = [];

        foreach ($data['files'] as $file) {
            $filesRequestArray[] = $file;
        }

        return $filesRequestArray;
    }

    protected function buildUploadRequestBody(UploadedFile $file, string $contactId ): array
    {
        $now = new DateTime();

        $requestBody = [
            ['name' => 'file[relatedContact]', 'contents' => (int) $contactId],
            ['name' => 'file[uploadedAt]', 'contents' =>  $now->format('Y-m-d H:i:s')],
        ];

        $requestBody[] = $this->getMultipartRequestFile($file);

        return $requestBody;
    }

    protected function getMultipartRequestFile(?UploadedFile $uploadedFile): array
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
                    'name' => 'file[file][content]',
                    'contents' => $uploadedOpenedFile,
                    'filename' => $originalFileName ?? $defaultFileName,
                ];
            }
        }

        return [];
    }

    protected function getRequestHeaders(string $accessToken): array
    {
        return [
            'Authorization' => 'Bearer ' . $accessToken,
        ];
    }

    private function createAccessToken(): string
    {
        try {
            $response = $this->client->request(
                'POST',
                '/oauth2-token',
                [
                    'form_params' => [
                        'grant_type' => 'client_credentials',
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                    ],
                ]
            );
        } catch (ClientException $exception) {

            throw new OroException($exception->getMessage());
        } catch (ServerException $exception) {

            throw new OroException($exception->getMessage());
        }

        $responseContent = json_decode($response->getBody()->getContents(), true);

        $this->accessToken = $responseContent['access_token'];
        apcu_store('accessToken', $this->accessToken, 3000);

        return $this->accessToken;
    }
}
