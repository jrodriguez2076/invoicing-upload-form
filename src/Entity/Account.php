<?php

declare(strict_types=1);

namespace App\Entity;

class Account
{
    /**
     * @var string
     */
    protected $firstName = '';

    /**
     * @var string
     */
    protected $lastName = '';

    /**
     * @var string
     */
    protected $phoneNumber = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $accountName = '';

    /**
     * @var string
     */
    protected $bankAcctHolder = '';

    /**
     * @var string
     */
    protected $bankAcctNumber = '';

    /**
     * @var string
     */
    protected $bankName = '';

    /**
     * @var string
     */
    protected $bankCode = '';

    /**
     * @var string
     */
    protected $bankRegistrationNumber = '';

    /**
     * @var string
     */
    protected $bankIban = '';

    /**
     * @var string
     */
    protected $bankCertificate = '';

    /**
     * @var string
     */
    protected $contributorType = '';

    /**
     * @var string
     */
    protected $economicActivity = '';

    /**
     * @var string
     */
    protected $warehouseContact = '';

    /**
     * @var string
     */
    protected $warehouseAddress = '';

    /**
     * @var string
     */
    protected $warehouseAddressExtraData = '';

    /**
     * @var string
     */
    protected $warehouseAddressExtraData2 = '';

    /**
     * @var string
     */
    protected $warehouseAddressExtraData3 = '';

    /**
     * @var string
     */
    protected $warehouseAddressExtraData4 = '';

    /**
     * @var string
     */
    protected $warehouseAddress2 = '';

    /**
     * @var string
     */
    protected $warehousePhone = '';

    /**
     * @var string
     */
    protected $warehousePostalCode = '';

    /**
     * @var string
     */
    protected $warehouseCity = '';

    /**
     * @var string
     */
    protected $warehouseMode = '';

    /**
     * @var string
     */
    protected $warrantyContact = '';

    /**
     * @var string
     */
    protected $legalName = '';

    /**
     * @var string
     */
    protected $legalAddress = '';

    /**
     * @var string
     */
    protected $legalAddress2 = '';

    /**
     * @var string
     */
    protected $legalPostalCode = '';

    /**
     * @var string
     */
    protected $legalCountry = '';

    /**
     * @var string
     */
    protected $legalCity = '';

    /**
     * @var string
     */
    protected $legalRepresentative = '';

    /**
     * @var string
     */
    protected $fiscalIdNumber = '';

    /**
     * @var string
     */
    protected $idAdditionalDoc = '';

    /**
     * @var string
     */
    protected $fiscalIdAdditionalDoc = '';

    /**
     * @var string
     */
    protected $financeContactName = '';

    /**
     * @var string
     */
    protected $financeContactMail = '';

    /**
     * @var string
     */
    protected $financeContactPhone = '';

    /**
     * @var string
     */
    protected $logisticDocument = '';

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): void
    {
        $this->accountName = $accountName;
    }

    public function getBankAcctHolder(): string
    {
        return $this->bankAcctHolder;
    }

    public function setBankAcctHolder(string $bankAcctHolder): void
    {
        $this->bankAcctHolder = $bankAcctHolder;
    }

    public function getBankAcctNumber(): string
    {
        return $this->bankAcctNumber;
    }

    public function setBankAcctNumber(string $bankAcctNumber): void
    {
        $this->bankAcctNumber = $bankAcctNumber;
    }

    public function getBankName(): string
    {
        return $this->bankName;
    }

    public function setBankName(string $bankName): void
    {
        $this->bankName = $bankName;
    }

    public function getBankCode(): string
    {
        return $this->bankCode;
    }

    public function setBankCode(string $bankCode): void
    {
        $this->bankCode = $bankCode;
    }

    public function getBankRegistrationNumber(): string
    {
        return $this->bankRegistrationNumber;
    }

    public function setBankRegistrationNumber(string $bankRegistrationNumber): void
    {
        $this->bankRegistrationNumber = $bankRegistrationNumber;
    }

    public function getBankIban(): string
    {
        return $this->bankIban;
    }

    public function setBankIban(string $bankIban): void
    {
        $this->bankIban = $bankIban;
    }

    public function getBankCertificate(): string
    {
        return $this->bankCertificate;
    }

    public function setBankCertificate(?string $bankCertificate = ''): void
    {
        $this->bankCertificate = $bankCertificate;
    }

    public function getContributorType(): string
    {
        return $this->contributorType;
    }

    public function setContributorType(string $contributorType): void
    {
        $this->contributorType = $contributorType;
    }

    public function getEconomicActivity(): string
    {
        return $this->economicActivity;
    }

    public function setEconomicActivity(string $economicActivity): void
    {
        $this->economicActivity = $economicActivity;
    }

    public function getWarehouseContact(): string
    {
        return $this->warehouseContact;
    }

    public function setWarehouseContact(string $warehouseContact): void
    {
        $this->warehouseContact = $warehouseContact;
    }

    public function getWarehouseAddress(): string
    {
        return $this->warehouseAddress;
    }

    public function setWarehouseAddress(string $warehouseAddress): void
    {
        $this->warehouseAddress = $warehouseAddress;
    }

    public function getWarehouseAddressExtraData(): string
    {
        return $this->warehouseAddressExtraData;
    }

    public function setWarehouseAddressExtraData(string $warehouseAddressExtraData): void
    {
        $this->warehouseAddressExtraData = $warehouseAddressExtraData;
    }

    public function getWarehouseAddressExtraData2(): string
    {
        return $this->warehouseAddressExtraData2;
    }

    public function setWarehouseAddressExtraData2(string $warehouseAddressExtraData2): void
    {
        $this->warehouseAddressExtraData2 = $warehouseAddressExtraData2;
    }

    public function getWarehouseAddressExtraData3(): string
    {
        return $this->warehouseAddressExtraData3;
    }

    public function setWarehouseAddressExtraData3(string $warehouseAddressExtraData3): void
    {
        $this->warehouseAddressExtraData3 = $warehouseAddressExtraData3;
    }

    public function getWarehouseAddressExtraData4(): string
    {
        return $this->warehouseAddressExtraData4;
    }

    public function setWarehouseAddressExtraData4(string $warehouseAddressExtraData4): void
    {
        $this->warehouseAddressExtraData4 = $warehouseAddressExtraData4;
    }

    public function getWarehouseAddress2(): string
    {
        return $this->warehouseAddress2;
    }

    public function setWarehouseAddress2(string $warehouseAddress2): void
    {
        $this->warehouseAddress2 = $warehouseAddress2;
    }

    public function getWarehousePhone(): string
    {
        return $this->warehousePhone;
    }

    public function setWarehousePhone(string $warehousePhone): void
    {
        $this->warehousePhone = $warehousePhone;
    }

    public function getWarehousePostalCode(): string
    {
        return $this->warehousePostalCode;
    }

    public function setWarehousePostalCode(string $warehousePostalCode): void
    {
        $this->warehousePostalCode = $warehousePostalCode;
    }

    public function getWarehouseCity(): string
    {
        return $this->warehouseCity;
    }

    public function setWarehouseCity(string $warehouseCity): void
    {
        $this->warehouseCity = $warehouseCity;
    }

    public function getWarehouseMode(): string
    {
        return $this->warehouseMode;
    }

    public function setWarehouseMode(string $warehouseMode): void
    {
        $this->warehouseMode = $warehouseMode;
    }

    public function getWarrantyContact(): string
    {
        return $this->warrantyContact;
    }

    public function setWarrantyContact(string $warrantyContact): void
    {
        $this->warrantyContact = $warrantyContact;
    }

    public function getLegalName(): string
    {
        return $this->legalName;
    }

    public function setLegalName(string $legalName): void
    {
        $this->legalName = $legalName;
    }

    public function getLegalAddress(): string
    {
        return $this->legalAddress;
    }

    public function setLegalAddress(string $legalAddress): void
    {
        $this->legalAddress = $legalAddress;
    }

    public function getLegalAddress2(): string
    {
        return $this->legalAddress2;
    }

    public function setLegalAddress2(string $legalAddress2): void
    {
        $this->legalAddress2 = $legalAddress2;
    }

    public function getLegalPostalCode(): string
    {
        return $this->legalPostalCode;
    }

    public function setLegalPostalCode(string $legalPostalCode): void
    {
        $this->legalPostalCode = $legalPostalCode;
    }

    public function getLegalCountry(): string
    {
        return $this->legalCountry;
    }

    public function setLegalCountry(string $legalCountry): void
    {
        $this->legalCountry = $legalCountry;
    }

    public function getLegalCity(): string
    {
        return $this->legalCity;
    }

    public function setLegalCity(string $legalCity): void
    {
        $this->legalCity = $legalCity;
    }

    public function getLegalRepresentative(): string
    {
        return $this->legalRepresentative;
    }

    public function setLegalRepresentative(string $legalRepresentative): void
    {
        $this->legalRepresentative = $legalRepresentative;
    }

    public function getFiscalIdNumber(): string
    {
        return $this->fiscalIdNumber;
    }

    public function setFiscalIdNumber(string $fiscalIdNumber): void
    {
        $this->fiscalIdNumber = $fiscalIdNumber;
    }

    public function getIdAdditionalDoc(): string
    {
        return $this->idAdditionalDoc;
    }

    public function setIdAdditionalDoc(?string $idAdditionalDoc = ''): void
    {
        $this->idAdditionalDoc = $idAdditionalDoc;
    }

    public function getFiscalIdAdditionalDoc(): string
    {
        return $this->fiscalIdAdditionalDoc;
    }

    public function setFiscalIdAdditionalDoc(?string $fiscalIdAdditionalDoc = ''): void
    {
        $this->fiscalIdAdditionalDoc = $fiscalIdAdditionalDoc;
    }

    public function getLogisticDocument(): string
    {
        return $this->logisticDocument;
    }

    public function setLogisticDocument(?string $logisticDocument = ''): void
    {
        $this->logisticDocument = $logisticDocument;
    }

    public function getFinanceContactName(): string
    {
        return $this->financeContactName;
    }

    public function setFinanceContactName(string $financeContactName): void
    {
        $this->financeContactName = $financeContactName;
    }

    public function getFinanceContactMail(): string
    {
        return $this->financeContactMail;
    }

    public function setFinanceContactMail(string $financeContactMail): void
    {
        $this->financeContactMail = $financeContactMail;
    }

    public function getFinanceContactPhone(): string
    {
        return $this->financeContactPhone;
    }

    public function setFinanceContactPhone(string $financeContactPhone): void
    {
        $this->financeContactPhone = $financeContactPhone;
    }
}
