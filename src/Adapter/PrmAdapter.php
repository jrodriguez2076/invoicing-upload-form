<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Account;
use App\Entity\Contact;
use App\Exception\PrmException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

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

    public function __construct(ClientInterface $client, string $clientId, string $clientSecret)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function createAccount(Account $account): void
    {
        $requestBody = $this->createAccountRequest($account);

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
            throw new PrmException($exception->getMessage());
        } catch (ServerException $exception) {
            throw new PrmException($exception->getMessage());
        }
    }

    public function createContact(Contact $contact): void
    {
        $requestBody = $this->createContactRequest($contact);

        try {
            $response = $this->client->request(
                'POST',
                '/api/rest/latest/contacts',
                [
                    'headers' => $this->getWsseHeaders(),
                    'json' => $requestBody,
                ]
            );
        } catch (ClientException $exception) {
            throw new PrmException($exception->getMessage());
        } catch (ServerException $exception) {
            throw new PrmException($exception->getMessage());
        }

        if ($response->getStatusCode() != 200 and $response->getStatusCode() != 201) {
            throw new PrmException('CONTACT_CREATE_ERROR', 500);
        }
    }

    protected function createAccountRequest(Account $account): array
    {
        return [
            'account' => [
            ],
        ];
    }

    protected function createContactRequest(Contact $contact): array
    {
        return [
            'contact' => [
                'firstName' => $contact->getFirstName(),
                'lastName' => $contact->getLastName(),
                'phones' => [
                    [
                        'phone' => $contact->getPhoneNumber(),
                    ],
                ],
                'emails' => [
                    [
                        'email' => $contact->getEmail(),
                        'primary' => true,
                    ],
                ],
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
