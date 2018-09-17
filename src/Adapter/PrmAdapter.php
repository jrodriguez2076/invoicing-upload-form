<?php

declare(strict_types=1);

namespace App\Adapter;

use App\Entity\Account;
use App\Entity\Contact;
use App\Entity\Opportunity;
use App\Exception\PrmException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function createAccount(Account $account, Contact $contact, Opportunity $opportunity, string $store): int
    {
        $requestBody = $this->buildAccountRequestBody($account, $contact, $opportunity, $store);

        try {
            $this->logger->info('Attempting to create account');
            $response = $this->client->request(
                'POST',
                '/api/rest/latest/accounts',
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
            $this->logger->error('ACCOUNT_CREATE_ERROR', [
                'response' => [
                    'body' => $response->getBody()->getContents(),
                ],
            ]);

            throw new PrmException('ACCOUNT_CREATE_ERROR', 500);
        }

        $responseContent = $response->getBody()->getContents();
        $jsonResponseContent = json_decode($responseContent, true);

        if (!isset($jsonResponseContent['id'])) {
            throw new PrmException('ACCOUNT_CREATE_ERROR', 500);
        }

        $this->logger->info('Account created');

        return $jsonResponseContent['id'];
    }

    public function createContact(Contact $contact): int
    {
        $requestBody = $this->buildContactRequestBody($contact);

        try {
            $this->logger->info('Attempting to create contact');
            $response = $this->client->request(
                'POST',
                '/api/rest/latest/contacts',
                [
                    'headers' => $this->getWsseHeaders(),
                    'json' => $requestBody,
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

        if ($response->getStatusCode() != 200 and $response->getStatusCode() != 201) {
            $this->logger->error('CONTACT_CREATE_ERROR', [
                'response' => [
                    'body' => $response->getBody()->getContents(),
                ],
            ]);

            throw new PrmException('CONTACT_CREATE_ERROR', 500);
        }

        $responseContent = $response->getBody()->getContents();
        $jsonResponseContent = json_decode($responseContent, true);

        if (!isset($jsonResponseContent['id'])) {
            throw new PrmException('CONTACT_CREATE_ERROR', 500);
        }

        $this->logger->info('Contact created');

        return $jsonResponseContent['id'];
    }

    public function createOpportunity(Opportunity $opportunity, Account $account, Contact $contact, string $store, string $hunter): void
    {
        $requestBody = $this->buildOpportunityRequestBody($opportunity, $account, $contact, $store, $hunter);

        try {
            $this->logger->info('Attempting to create opportunity');
            $response = $this->client->request(
                'POST',
                '/api/rest/latest/opportunities',
                [
                    'headers' => $this->getWsseHeaders(),
                    'json' => $requestBody,
                ]
            );
        } catch (ClientException $exception) {
            $this->logger->error($exception->getResponse()->getBody()->getContents());
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

        if ($response->getStatusCode() != 200 and $response->getStatusCode() != 201) {
            $this->logger->error('OPPORTUNITY_CREATE_ERROR', [
                'response' => [
                    'body' => $response->getBody()->getContents(),
                ],
            ]);

            throw new PrmException('OPPORTUNITY_CREATE_ERROR', 500);
        }
        $this->logger->info('Opportunity created');
    }

    protected function buildContactRequestBody(Contact $contact): array
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

    protected function buildAccountRequestBody(Account $account, Contact $contact, Opportunity $opportunity, string $store): array
    {
        $request = [
            ['name' => 'account[name]', 'contents' => $account->getAccountName()],
            ['name' => 'account[businessName]', 'contents' => $account->getAccountName()],
            ['name' => 'account[phone]', 'contents' => $contact->getPhoneNumber()],
            ['name' => 'account[owner]', 'contents' => $account::DEFAULT_OWNER],
            ['name' => 'account[countryId]', 'contents' => $store],
            ['name' => 'account[bankAcctHolder]', 'contents' => $account->getBankAcctHolder()],
            ['name' => 'account[bankAcctNumber]', 'contents' => $account->getBankAcctNumber()],
            ['name' => 'account[bankCode]', 'contents' => $account->getBankCode()],
            ['name' => 'account[bankIban]', 'contents' => $account->getBankIban()],
            ['name' => 'account[bankName]', 'contents' => $account->getBankName()],
            ['name' => 'account[bankRegNumber]', 'contents' => $account->getBankRegistrationNumber()],
            ['name' => 'account[legalName]', 'contents' => $account->getLegalName()],
            ['name' => 'account[legalCity]', 'contents' => $account->getLegalCity()],
            ['name' => 'account[legalCountry]', 'contents' => $account->getLegalCountry()],
            ['name' => 'account[legalAddress]', 'contents' => $account->getLegalAddress()],
            ['name' => 'account[legalAddress2]', 'contents' => $account->getLegalAddress2()],
            ['name' => 'account[legalRepresentative]', 'contents' => $account->getLegalRepresentative()],
            ['name' => 'account[legalPostalCode]', 'contents' => $account->getLegalPostalCode()],
            ['name' => 'account[default_contact]', 'contents' => $contact->getId()],
            ['name' => 'account[contributorType]', 'contents' => $account->getContributorType()],
            ['name' => 'account[economicActivity]', 'contents' => $account->getEconomicActivity()],
            ['name' => 'account[emailAddress]', 'contents' => $contact->getEmail()],
            ['name' => 'account[fiscalIdNumber]', 'contents' => $account->getFiscalIdNumber()],
            ['name' => 'account[warehouseAddress]', 'contents' => $account->getWarehouseAddress()],
            ['name' => 'account[warehouseAddress2]', 'contents' => $account->getWarehouseAddress2()],
            ['name' => 'account[warehouseCity]', 'contents' => $account->getWarehouseCity()],
            ['name' => 'account[warehouseContact]', 'contents' => $account->getWarehouseContact()],
            ['name' => 'account[warehousePhone]', 'contents' => $account->getWarehousePhone()],
            ['name' => 'account[warehousePostalCode]', 'contents' => $account->getWarehousePostalCode()],
            ['name' => 'account[warehouseCountry]', 'contents' => $account->getWarehouseCountry()],
            ['name' => 'account[warrantyContact]', 'contents' => $account->getWarrantyContact()],
            ['name' => 'account[financeContactName]', 'contents' => $account->getFinanceContactName()],
            ['name' => 'account[financeContactMail]', 'contents' => $account->getFinanceContactMail()],
            ['name' => 'account[financeContactPhone]', 'contents' => $account->getFinanceContactPhone()],
            ['name' => 'account[supplyGeography]', 'contents' => $account->getSupplyGeography()],
            ['name' => 'account[website]', 'contents' => $opportunity->getWebsite()],
        ];

        $bankCertificate = $account->getBankCertificate();
        $bankCertificateFileRequest = $this->getMultipartRequestFile($bankCertificate, 'bankCertificate');
        if (!empty($bankCertificateFileRequest)) {
            $request[] = $bankCertificateFileRequest;
        }

        $fiscalIdAdditionalDoc = $account->getFiscalIdAdditionalDoc();
        $fiscalIdAdditionalDocFileRequest = $this->getMultipartRequestFile($fiscalIdAdditionalDoc, 'fiscalIdDocument');
        if (!empty($fiscalIdAdditionalDocFileRequest)) {
            $request[] = $fiscalIdAdditionalDocFileRequest;
        }

        $idAdditionalDoc = $account->getIdAdditionalDoc();
        $idAdditionalDocFileRequest = $this->getMultipartRequestFile($idAdditionalDoc, 'idAdditionalDoc');
        if (!empty($idAdditionalDocFileRequest)) {
            $request[] = $idAdditionalDocFileRequest;
        }

        $logisticDocument = $account->getLogisticDocument();
        $logisticDocumentFileRequest = $this->getMultipartRequestFile($logisticDocument, 'logisticDocument');
        if (!empty($logisticDocumentFileRequest)) {
            $request[] = $logisticDocumentFileRequest;
        }

        return $request;
    }

    protected function buildOpportunityRequestBody(Opportunity $opportunity, Account $account, Contact $contact, string $store, string $hunter): array
    {
        $requestBody = [
            'opportunity' => [
                'name' => $account->getAccountName(),
                'brand1' => $opportunity->getBrand1(),
                'brand2' => $opportunity->getBrand2(),
                'brand3' => $opportunity->getBrand3(),
                'earningsEstimate' => $opportunity->getEarningsEstimate(),
                'integrationFlag' => $opportunity->getIntegrationFlag(),
                'mainCategory' => $opportunity->getMainCategory(),
                'secondaryCategory' => $opportunity->getSecondaryCategory(),
                'marketingInvest' => $opportunity->getMarketingInvest(),
                'delivery' => $opportunity->isOperativeCheckDelivery(),
                'inventory' => $opportunity->isOperativeCheckInventory(),
                'invoices' => $opportunity->isOperativeCheckInvoices(),
                'legallyConstituted' => $opportunity->isOperativeCheckLegallyConstituted(),
                'returns' => $opportunity->isOperativeCheckReturns(),
                'catalog' => $opportunity->isOperativeCheckCatalog(),
                'shippingAgreement' => $opportunity->isOperativeCheckShippingAgreement(),
                'otherStoreName' => $opportunity->getOtherStoreName(),
                'otherStoreAddress' => $opportunity->getOtherStoresAddress(),
                'otherStoresList' => $opportunity->getOtherStoresList(),
                'otherStoresRating' => $opportunity->getOtherStoresRating(),
                'potentialCatalog' => $opportunity->getPotentialCatalog(),
                'website' => $opportunity->getWebsite(),
                'contact' => $contact->getId(),
                'accountId' => $account->getId(),
                'countryId' => $store,
                'registrationType' => Opportunity::ORGANIC_REGISTRATION_TYPE,
                'processingTime' => $opportunity->getProcessingTime(),
                'surveyComment' => $opportunity->getSurveyComment(),
            ],
        ];

        if (!empty($hunter)) {
            $requestBody['opportunity']['registrationType'] = Opportunity::HUNTED_REGISTRATION_TYPE;
            $requestBody['opportunity']['accountHunter'] = $hunter;
        }

        return $requestBody;
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

    protected function getMultipartRequestFile(?UploadedFile $uploadedFile, string $fieldName): array
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
                    'name' => sprintf('account[%s][file]', $fieldName),
                    'contents' => $uploadedOpenedFile,
                    'filename' => $originalFileName ?? $defaultFileName,
                ];
            }
        }

        return [];
    }
}
