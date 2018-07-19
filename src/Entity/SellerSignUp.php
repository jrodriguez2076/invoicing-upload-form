<?php

declare(strict_types=1);

namespace App\Entity;

class SellerSignUp
{
    /**
     * @var Contact
     */
    protected $contact;

    /**
     * @var Account
     */
    protected $account;

    /**
     * @var Opportunity
     */
    protected $opportunity;

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): void
    {
        $this->contact = $contact;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(Account $account): void
    {
        $this->account = $account;
    }

    public function getOpportunity(): ?Opportunity
    {
        return $this->opportunity;
    }

    public function setOpportunity(Opportunity $opportunity): void
    {
        $this->opportunity = $opportunity;
    }
}
