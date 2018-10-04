<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\PrmAdapter;
use App\Entity\Contact;
use App\Entity\SellerSignUp;
use App\Exception\PrmException;

class PrmService
{
    /**
     * @var PrmAdapter
     */
    protected $adapter;

    public function __construct(PrmAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @throws PrmException
     */
    public function createContact(Contact $contact): void
    {
        $this->adapter->createContact($contact);
    }

    public function processFormData(SellerSignUp $sellerSignUp, string $store, string $hunter): void
    {
        $contact = $sellerSignUp->getContact();
        $account = $sellerSignUp->getAccount();
        $opportunity = $sellerSignUp->getOpportunity();

        $contactId = $this->adapter->createContact($contact);
        $contact->setId($contactId);

        $accountId = $this->adapter->createAccount($account, $contact, $opportunity, $store, $hunter);
        $account->setId($accountId);

        if ($store == 'international') {
            foreach ($opportunity->getOpportunityCountries() as $country) {
                $this->adapter->createOpportunity($opportunity, $account, $contact, $country, $hunter);
            }
        } else {
            $this->adapter->createOpportunity($opportunity, $account, $contact, $store, $hunter);
        }
    }
}
