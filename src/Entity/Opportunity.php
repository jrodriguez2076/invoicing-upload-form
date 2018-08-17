<?php

declare(strict_types=1);

namespace App\Entity;

class Opportunity
{
    public const ORGANIC_REGISTRATION_TYPE = 'Orgánica';
    public const HUNTED_REGISTRATION_TYPE = 'Hunteada';

    /**
     * @var bool
     */
    protected $operativeCheckLegallyConstituted = false;

    /**
     * @var bool
     */
    protected $operativeCheckInventory = false;

    /**
     * @var bool
     */
    protected $operativeCheckDelivery = false;

    /**
     * @var bool
     */
    protected $operativeCheckReturns = false;

    /**
     * @var bool
     */
    protected $operativeCheckShippingAgreement = false;

    /**
     * @var bool
     */
    protected $operativeCheckInvoices = false;

    /**
     * @var string
     */
    protected $earningsEstimate = '';

    /**
     * @var string
     */
    protected $mainCategory = '';

    /**
     * @var string
     */
    protected $secondaryCategory = '';

    /**
     * @var string
     */
    protected $potentialCatalog = '';

    /**
     * @var string
     */
    protected $website = '';

    /**
     * @var string
     */
    protected $otherStoresList = '';

    /**
     * @var string
     */
    protected $otherStoreName = '';

    /**
     * @var string
     */
    protected $otherStoresAddress = '';

    /**
     * @var string
     */
    protected $otherStoresRating = '';

    /**
     * @var string
     */
    protected $officialDistributorBrand = '';

    /**
     * @var string
     */
    protected $brand1 = '';

    /**
     * @var string
     */
    protected $brand2 = '';

    /**
     * @var string
     */
    protected $brand3 = '';

    /**
     * @var string
     */
    protected $marketingInvest = '';

    /**
     * @var string
     */
    protected $integrationFlag = '';

    /**
     * @var bool
     */
    protected $operativeCheckCatalog = false;

    public function isOperativeCheckLegallyConstituted(): bool
    {
        return $this->operativeCheckLegallyConstituted;
    }

    public function setOperativeCheckLegallyConstituted(?bool $operativeCheckLegallyConstituted): void
    {
        $this->operativeCheckLegallyConstituted = (bool) $operativeCheckLegallyConstituted;
    }

    public function isOperativeCheckInventory(): bool
    {
        return $this->operativeCheckInventory;
    }

    public function setOperativeCheckInventory(?bool $operativeCheckInventory): void
    {
        $this->operativeCheckInventory = (bool) $operativeCheckInventory;
    }

    public function isOperativeCheckDelivery(): bool
    {
        return $this->operativeCheckDelivery;
    }

    public function setOperativeCheckDelivery(?bool $operativeCheckDelivery): void
    {
        $this->operativeCheckDelivery = (bool) $operativeCheckDelivery;
    }

    public function isOperativeCheckReturns(): bool
    {
        return $this->operativeCheckReturns;
    }

    public function setOperativeCheckReturns(?bool $operativeCheckReturns): void
    {
        $this->operativeCheckReturns = (bool) $operativeCheckReturns;
    }

    public function isOperativeCheckShippingAgreement(): bool
    {
        return $this->operativeCheckShippingAgreement;
    }

    public function setOperativeCheckShippingAgreement(?bool $operativeCheckShippingAgreement): void
    {
        $this->operativeCheckShippingAgreement = (bool) $operativeCheckShippingAgreement;
    }

    public function isOperativeCheckInvoices(): bool
    {
        return $this->operativeCheckInvoices;
    }

    public function setOperativeCheckInvoices(?bool $operativeCheckInvoices): void
    {
        $this->operativeCheckInvoices = (bool) $operativeCheckInvoices;
    }

    public function getEarningsEstimate(): ?string
    {
        return $this->earningsEstimate;
    }

    public function setEarningsEstimate(?string $earningsEstimate): void
    {
        $this->earningsEstimate = $earningsEstimate;
    }

    public function getMainCategory(): ?string
    {
        return $this->mainCategory;
    }

    public function setMainCategory(?string $mainCategory): void
    {
        $this->mainCategory = $mainCategory;
    }

    public function getSecondaryCategory(): ?string
    {
        return $this->secondaryCategory;
    }

    public function setSecondaryCategory(?string $secondaryCategory): void
    {
        $this->secondaryCategory = $secondaryCategory;
    }

    public function getPotentialCatalog(): ?string
    {
        return $this->potentialCatalog;
    }

    public function setPotentialCatalog(?string $potentialCatalog): void
    {
        $this->potentialCatalog = $potentialCatalog;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = $website;
    }

    public function getOtherStoresList(): ?string
    {
        return $this->otherStoresList;
    }

    public function setOtherStoresList(?string $otherStoresList): void
    {
        $this->otherStoresList = $otherStoresList;
    }

    public function getOtherStoreName(): ?string
    {
        return $this->otherStoreName;
    }

    public function setOtherStoreName(?string $otherStoreName): void
    {
        $this->otherStoreName = $otherStoreName;
    }

    public function getOtherStoresAddress(): ?string
    {
        return $this->otherStoresAddress;
    }

    public function setOtherStoresAddress(?string $otherStoresAddress): void
    {
        $this->otherStoresAddress = $otherStoresAddress;
    }

    public function getOtherStoresRating(): ?string
    {
        return $this->otherStoresRating;
    }

    public function setOtherStoresRating(?string $otherStoresRating): void
    {
        $this->otherStoresRating = $otherStoresRating;
    }

    public function getOfficialDistributorBrand(): ?string
    {
        return $this->officialDistributorBrand;
    }

    public function setOfficialDistributorBrand(?string $officialDistributorBrand): void
    {
        $this->officialDistributorBrand = $officialDistributorBrand;
    }

    public function getBrand1(): ?string
    {
        return $this->brand1;
    }

    public function setBrand1(?string $brand1): void
    {
        $this->brand1 = $brand1;
    }

    public function getBrand2(): ?string
    {
        return $this->brand2;
    }

    public function setBrand2(?string $brand2): void
    {
        $this->brand2 = $brand2;
    }

    public function getBrand3(): ?string
    {
        return $this->brand3;
    }

    public function setBrand3(?string $brand3): void
    {
        $this->brand3 = $brand3;
    }

    public function getMarketingInvest(): ?string
    {
        return $this->marketingInvest;
    }

    public function setMarketingInvest(?string $marketingInvest): void
    {
        $this->marketingInvest = $marketingInvest;
    }

    public function getIntegrationFlag(): ?string
    {
        return $this->integrationFlag;
    }

    public function setIntegrationFlag(?string $integrationFlag): void
    {
        $this->integrationFlag = $integrationFlag;
    }

    public function isOperativeCheckCatalog(): bool
    {
        return $this->operativeCheckCatalog;
    }

    public function setOperativeCheckCatalog(?bool $operativeCheckCatalog): void
    {
        $this->operativeCheckCatalog = (bool) $operativeCheckCatalog;
    }
}
