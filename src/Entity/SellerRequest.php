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
    protected $phoneNumber = '';

    /**
     * @var string
     */
    protected $accountName = '';

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
    protected $acceptManifest = false;

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $legalName = '';

    /**
     * @var string
     */
    protected $contributorType = '';

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
    protected $country = '';

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
    protected $city = '';

    /**
     * @var string
     */
    protected $postalCode = '';

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
    protected $warehouseContact = '';

    /**
     * @var string
     */
    protected $warehouseAddress = '';

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
     * @var boolean
     */
    protected $operativeCheckLegallyConstituted = false;

    /**
     * @var boolean
     */
    protected $operativeCheckInventory = false;

    /**
     * @var boolean
     */
    protected $operativeCheckDelivery = false;

    /**
     * @var boolean
     */
    protected $operativeCheckReturns = false;

    /**
     * @var boolean
     */
    protected $operativeCheckShippingAgreement = false;

    /**
     * @var boolean
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
     * @var string
     */
    protected $economicActivity = '';

    /**
     * @var string
     */
    protected $logisticDocument = '';

    /**
     * @var string
     */
    protected $warrantyContact = '';

    /**
     * @var boolean
     */
    protected $operativeCheckCatalog = false;

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

    public function getLegalName(): string
    {
        return $this->legalName;
    }

    public function setLegalName(string $legalName): void
    {
        $this->legalName = $legalName;
    }

    public function getContributorType(): string
    {
        return $this->contributorType;
    }

    public function setContributorType(string $contributorType): void
    {
        $this->contributorType = $contributorType;
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

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
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

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getIdAdditionalDoc(): string
    {
        return $this->idAdditionalDoc;
    }

    public function setIdAdditionalDoc(string $idAdditionalDoc): void
    {
        $this->idAdditionalDoc = $idAdditionalDoc;
    }

    public function getFiscalIdAdditionalDoc(): string
    {
        return $this->fiscalIdAdditionalDoc;
    }

    public function setFiscalIdAdditionalDoc(string $fiscalIdAdditionalDoc): void
    {
        $this->fiscalIdAdditionalDoc = $fiscalIdAdditionalDoc;
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

    public function setBankCertificate(string $bankCertificate): void
    {
        $this->bankCertificate = $bankCertificate;
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

    public function getWarehouseMode(): string
    {
        return $this->warehouseMode;
    }

    public function setWarehouseMode(string $warehouseMode): void
    {
        $this->warehouseMode = $warehouseMode;
    }

    public function getWarehouseCity(): string
    {
        return $this->warehouseCity;
    }

    public function setWarehouseCity(string $warehouseCity): void
    {
        $this->warehouseCity = $warehouseCity;
    }

    public function isOperativeCheckLegallyConstituted(): bool
    {
        return $this->operativeCheckLegallyConstituted;
    }

    public function setOperativeCheckLegallyConstituted(bool $operativeCheckLegallyConstituted): void
    {
        $this->operativeCheckLegallyConstituted = $operativeCheckLegallyConstituted;
    }

    public function isOperativeCheckCatalog(): bool
    {
        return $this->operativeCheckCatalog;
    }

    public function setOperativeCheckCatalog(bool $operativeCheckCatalog): void
    {
        $this->operativeCheckCatalog = $operativeCheckCatalog;
    }

    public function isOperativeCheckInventory(): bool
    {
        return $this->operativeCheckInventory;
    }

    public function setOperativeCheckInventory(bool $operativeCheckInventory): void
    {
        $this->operativeCheckInventory = $operativeCheckInventory;
    }

    public function isOperativeCheckDelivery(): bool
    {
        return $this->operativeCheckDelivery;
    }

    public function setOperativeCheckDelivery(bool $operativeCheckDelivery): void
    {
        $this->operativeCheckDelivery = $operativeCheckDelivery;
    }

    public function isOperativeCheckReturns(): bool
    {
        return $this->operativeCheckReturns;
    }

    public function setOperativeCheckReturns(bool $operativeCheckReturns): void
    {
        $this->operativeCheckReturns = $operativeCheckReturns;
    }

    public function isOperativeCheckShippingAgreement(): bool
    {
        return $this->operativeCheckShippingAgreement;
    }

    public function setOperativeCheckShippingAgreement(bool $operativeCheckShippingAgreement): void
    {
        $this->operativeCheckShippingAgreement = $operativeCheckShippingAgreement;
    }

    public function isOperativeCheckInvoices(): bool
    {
        return $this->operativeCheckInvoices;
    }

    public function setOperativeCheckInvoices(bool $operativeCheckInvoices): void
    {
        $this->operativeCheckInvoices = $operativeCheckInvoices;
    }

    public function getEarningsEstimate(): string
    {
        return $this->earningsEstimate;
    }

    public function setEarningsEstimate(string $earningsEstimate): void
    {
        $this->earningsEstimate = $earningsEstimate;
    }

    public function getMainCategory(): string
    {
        return $this->mainCategory;
    }

    public function setMainCategory(string $mainCategory): void
    {
        $this->mainCategory = $mainCategory;
    }

    public function getSecondaryCategory(): string
    {
        return $this->secondaryCategory;
    }

    public function setSecondaryCategory(string $secondaryCategory): void
    {
        $this->secondaryCategory = $secondaryCategory;
    }

    public function getPotentialCatalog(): string
    {
        return $this->potentialCatalog;
    }

    public function setPotentialCatalog(string $potentialCatalog): void
    {
        $this->potentialCatalog = $potentialCatalog;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    public function getOtherStoresList(): string
    {
        return $this->otherStoresList;
    }

    public function setOtherStoresList(string $otherStoresList): void
    {
        $this->otherStoresList = $otherStoresList;
    }

    public function getOtherStoreName(): string
    {
        return $this->otherStoreName;
    }

    public function setOtherStoreName(string $otherStoreName): void
    {
        $this->otherStoreName = $otherStoreName;
    }

    public function getOtherStoresAddress(): string
    {
        return $this->otherStoresAddress;
    }

    public function setOtherStoresAddress(string $otherStoresAddress): void
    {
        $this->otherStoresAddress = $otherStoresAddress;
    }

    public function getOtherStoresRating(): string
    {
        return $this->otherStoresRating;
    }

    public function setOtherStoresRating(string $otherStoresRating): void
    {
        $this->otherStoresRating = $otherStoresRating;
    }

    public function getOfficialDistributorBrand(): string
    {
        return $this->officialDistributorBrand;
    }

    public function setOfficialDistributorBrand(string $officialDistributorBrand): void
    {
        $this->officialDistributorBrand = $officialDistributorBrand;
    }

    public function getBrand1(): string
    {
        return $this->brand1;
    }

    public function setBrand1(string $brand1): void
    {
        $this->brand1 = $brand1;
    }

    public function getBrand2(): string
    {
        return $this->brand2;
    }

    public function setBrand2(string $brand2): void
    {
        $this->brand2 = $brand2;
    }

    public function getBrand3(): string
    {
        return $this->brand3;
    }

    public function setBrand3(string $brand3): void
    {
        $this->brand3 = $brand3;
    }

    public function getMarketingInvest(): string
    {
        return $this->marketingInvest;
    }

    public function setMarketingInvest(string $marketingInvest): void
    {
        $this->marketingInvest = $marketingInvest;
    }

    public function getIntegrationFlag(): string
    {
        return $this->integrationFlag;
    }

    public function setIntegrationFlag(string $integrationFlag): void
    {
        $this->integrationFlag = $integrationFlag;
    }

    public function getEconomicActivity(): string
    {
        return $this->economicActivity;
    }

    public function setEconomicActivity(string $economicActivity): void
    {
        $this->economicActivity = $economicActivity;
    }

    public function getLogisticDocument(): string
    {
        return $this->logisticDocument;
    }

    public function setLogisticDocument(string $logisticDocument): void
    {
        $this->logisticDocument = $logisticDocument;
    }

    public function getWarrantyContact(): string
    {
        return $this->warrantyContact;
    }

    public function setWarrantyContact(string $warrantyContact): void
    {
        $this->warrantyContact = $warrantyContact;
    }

    public function getAccountManagerName(): string
    {
        return $this->accountManagerName;
    }

    public function setAccountManagerName(string $accountManagerName): void
    {
        $this->accountManagerName = $accountManagerName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): void
    {
        $this->accountName = $accountName;
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

    public function isAcceptManifest(): bool
    {
        return $this->acceptManifest;
    }

    public function setAcceptManifest(bool $acceptManifest): void
    {
        $this->acceptManifest = $acceptManifest;
    }

    public static function getContributorTypesChoices(string $country): array
    {
        switch ($country) {
            case 'mx':
                return [
                    '601-General de ley personas morales' => '601-General de ley personas morales',
                    '603-Personas morales con fines no lucrativos' => '603-Personas morales con fines no lucrativos',
                    '605-Sueldos y salarios e ingresos asimilados a salarios' => '605-Sueldos y salarios e ingresos asimilados a salarios',
                    '606-Arrendamiento' => '606-Arrendamiento',
                    '608-Demás ingresos' => '608-Demás ingresos',
                    '609-Consolidación' => '609-Consolidación',
                    '610-Residentes en el extranjero sin establecimiento permanente en México' => '610-Residentes en el extranjero sin establecimiento permanente en México',
                    '611-Ingresos por dividendos (socios y accionistas)' => '611-Ingresos por dividendos (socios y accionistas)',
                    '612-Personas físicas con actividades empresariales y profesionales' => '612-Personas físicas con actividades empresariales y profesionales',
                    '614-Ingresos por intereses' => '614-Ingresos por intereses',
                    '616-Sin obligaciones fiscales' => '616-Sin obligaciones fiscales',
                    '620-Sociedades cooperativas de producción que optan por diferir sus ingresos' => '620-Sociedades cooperativas de producción que optan por diferir sus ingresos',
                    '621-Incorporación fiscal' => '621-Incorporación fiscal',
                    '622-Actividades agrícolas, ganaderas, silvícolas y pesqueras' => '622-Actividades agrícolas, ganaderas, silvícolas y pesqueras',
                    '623-Opcional para grupos de sociedades' => '623-Opcional para grupos de sociedades',
                    '624-Coordinados' => '624-Coordinados',
                    '628-Hidrocarburos' => '628-Hidrocarburos',
                    '607-Régimen de enajenación o adquisición de bienes' => '607-Régimen de enajenación o adquisición de bienes',
                    '629-De los regímenes fiscales preferentes y de las empresas multinacionales' => '629-De los regímenes fiscales preferentes y de las empresas multinacionales',
                    '630-Enajenación de acciones en bolsa de valores' => '630-Enajenación de acciones en bolsa de valores',
                    '615-Régimen de los ingresos por obtención de premios' => '615-Régimen de los ingresos por obtención de premios',
                    'International seller' => 'International seller',
                ];
                break;
            case 'co':
                return [
                    'Régimen Simplificado' => 'Régimen Simplificado',
                    'Régimen Común' => 'Régimen Común',
                    'Gran Contribuyente' => 'Gran Contribuyente',
                ];
                break;
            case 'cl':
                return [
                    'Limitada' => 'Limitada',
                    'EIRL' => 'EIRL',
                    'SpA' => 'SpA',
                    'Persona Natural' => 'Persona Natural',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                ];
                break;
            case 'ar':
                return [
                    'Sociedad de Responsabilidad limitada ' => 'Sociedad de Responsabilidad limitada ',
                    'Monotributista' => 'Monotributista',
                    'Responsable Inscrito' => 'Responsable Inscrito',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                ];
                break;
            case 'ec':
                return [
                    'Persona jurídica' => 'Persona jurídica',
                    'Persona natural con negocio' => 'Persona natural con negocio',
                ];
                break;
            case 'pe':
                return [
                    'Sociedad Anónima Cerrada' => 'Sociedad Anónima Cerrada',
                    'S.R.L.' => 'PE-S.R.L.',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                    'Persona natural con negocio' => 'Persona natural con negocio',
                    'Empresa Individual de Responsabilidad Limitada' => 'Empresa Individual de Responsabilidad Limitada',
                ];
                break;
            case 'pa':
                return [
                    'Sociedad Colectiva de Responsabilidad Limitada' => 'Sociedad Colectiva de Responsabilidad Limitada',
                    'Sociedad Anónima' => 'Sociedad Anónima',
                    'Empresa Individual de Responsabilidad Limitada' => 'Empresa Individual de Responsabilidad Limitada',
                ];
                break;
            default:
                return [];
        }
    }

    public static function getMainCategoriesChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Electrodomésticos' => 'Electrodomésticos',
                    'Libros' => 'Libros',
                    'Celulares y Tablets' => 'Celulares y Tablets',
                    'Computación' => 'Computación',
                    'Moda' => 'Moda',
                    'Belleza y cuidado personal' => 'Belleza y cuidado personal',
                    'Hogar,Niños y bebés' => 'Hogar,Niños y bebés',
                    'Fotografía' => 'Fotografía',
                    'Deportes' => 'Deportes',
                    'TV/Audio/Video' => 'TV/Audio/Video',
                    'Videojuegos' => 'Videojuegos',
                    'Otro' => 'Otro',
                ];
                break;
        }
    }

    public static function getSecondaryCategoriesChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Electrodomésticos' => 'Electrodomésticos',
                    'Libros' => 'Libros',
                    'Celulares y Tablets' => 'Celulares y Tablets',
                    'Computación' => 'Computación',
                    'Moda' => 'Moda',
                    'Belleza y cuidado personal' => 'Belleza y cuidado personal',
                    'Hogar,Niños y bebés' => 'Hogar,Niños y bebés',
                    'Fotografía' => 'Fotografía',
                    'Deportes' => 'Deportes',
                    'TV/Audio/Video' => 'TV/Audio/Video',
                    'Videojuegos' => 'Videojuegos',
                    'Otro' => 'Otro',
                ];
                break;
        }
    }

    public static function getPotentialCatalogChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '1-29' => '1-29',
                    '30-60' => '30-60',
                    '61-150' => '61-150',
                    '151-500' => '151-500',
                    '501-1000' => '501-1000',
                    '1001+' => '1001+',
                ];
                break;
        }
    }

    public static function getOtherStoresRatingChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '5/5' => '5/5',
                    '4/5' => '4/5',
                    '3/5' => '3/5',
                    '2/5' => '2/5',
                    '1/5' => '1/5',
                ];
                break;
        }
    }

    public static function getOtherStoresListChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Amazon' => 'Amazon',
                    'Mercado Libre' => 'Mercado Libre',
                    'Walmart' => 'Walmart',
                    'Otra' => 'Otra',
                    'No vendo' => 'No vendo',
                ];
                break;
        }
    }

    public static function getMarketingInvestChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    '0' => '0',
                    '1-100' => '1-100',
                    '101-500' => '101-500',
                    '501-1000' => '501-1000',
                    '1001+' => '1001+',
                ];
                break;
        }
    }

    public static function getIntegrationFlagChoices(string $country): array
    {
        switch ($country) {
            default:
            case 'mx':
                return [
                    'Sí' => 'Sí',
                    'No' => 'No',
                ];
                break;
        }
    }

    public static function getWarehouseModeChoices(string $country): array
    {
        switch ($country) {
            case 'ar':
                return [
                    'Pickup' => 'P',
                    'Dropoff' => 'D',
                ];
                break;
            default:
                return [];
        }
    }
}
