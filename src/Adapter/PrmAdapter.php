<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Exception\PrmException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;

class PrmAdapter
{
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

    public function __construct(ClientInterface $client, string $clientId, string $clientSecret, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->logger = $logger;
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
