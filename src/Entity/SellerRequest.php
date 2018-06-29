<?php

declare(strict_types=1);

namespace App\Entity;

class SellerRequest
{
    /**
     * @var string
     */
    protected $accountManagerName = '';

    /**
     * @var string
     */
    protected $accountManagerLastName = '';

    /**
     * @var string
     */
    protected $phoneNumber = '';

    /**
     * @var string
     */
    protected $storeCommercialName = '';

    /**
     * @var boolean
     */
    protected $acceptTermsAndConditions = false;

    /**
     * @var boolean
     */
    protected $acceptCommissionsAndPaymentPolicy = false;

    /**
     * @var boolean
     */
    protected $manifest = false;

    /**
     * @var string
     */
    protected $email = '';

    public function getAccountManagerName(): string
    {
        return $this->accountManagerName;
    }

    public function setAccountManagerName(string $accountManagerName): void
    {
        $this->accountManagerName = $accountManagerName;
    }

    public function getAccountManagerLastName(): string
    {
        return $this->accountManagerLastName;
    }

    public function setAccountManagerLastName(string $accountManagerLastName): void
    {
        $this->accountManagerLastName = $accountManagerLastName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getStoreCommercialName(): string
    {
        return $this->storeCommercialName;
    }

    public function setStoreCommercialName(string $storeCommercialName): void
    {
        $this->storeCommercialName = $storeCommercialName;
    }

    public function isAcceptTermsAndConditions(): bool
    {
        return $this->acceptTermsAndConditions;
    }

    public function setAcceptTermsAndConditions(bool $acceptTermsAndConditions): void
    {
        $this->acceptTermsAndConditions = $acceptTermsAndConditions;
    }

    public function isAcceptCommissionsAndPaymentPolicy(): bool
    {
        return $this->acceptCommissionsAndPaymentPolicy;
    }

    public function setAcceptCommissionsAndPaymentPolicy(bool $acceptCommissionsAndPaymentPolicy): void
    {
        $this->acceptCommissionsAndPaymentPolicy = $acceptCommissionsAndPaymentPolicy;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function isManifest(): bool
    {
        return $this->manifest;
    }

    public function setManifest(bool $manifest): void
    {
        $this->manifest = $manifest;
    }

}
