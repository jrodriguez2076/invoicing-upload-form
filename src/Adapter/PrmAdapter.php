<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Entity\SellerSignUp;
use App\Exception\PrmException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class PrmAdapter
{
    /** @var ClientInterface */
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

    public function createAccount(SellerSignUp $sellerSignUp): void
    {
        $requestBody = $this->createRequest($sellerSignUp);

        try {
            $this->client->request(
                'POST',
                '/api/rest/latest/accounts',
                [
                    'headers' => $this->getWsseHeaders(),
                    'json' => $requestBody,
                ]
            );
        } catch (ClientException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody());

            throw new PrmException($responseBody['message']);
        } catch (ServerException $exception) {
            $responseBody = json_decode((string) $exception->getResponse()->getBody());

            throw new PrmException((string) $responseBody['message'], $responseBody);
        }
    }

    public function createRequest(SellerSignUp $sellerSignUp)
    {
        return [
            'account' => [
                'name' => $sellerSignUp->getAccountName(),
                'phone' => $sellerSignUp->getPhoneNumber(),
                'emailAddress' => $sellerSignUp->getEmail(),
                'countryId' => 'ec',
                'owner' => 1,
            ],
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
