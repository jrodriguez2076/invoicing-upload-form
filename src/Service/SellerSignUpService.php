<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SellerSignUpService
{
    /**
     * @var ParameterBagInterface
     */
    protected $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function getContributorTypesChoices(string $store): array
    {
        return $this->params->get($store)['contributor_types'] ?? [];
    }

    public function getMainCategoriesChoices(string $store): array
    {
        return $this->params->get($store)['main_categories'] ?? [];
    }

    public function getSecondaryCategoriesChoices(string $store): array
    {
        return $this->params->get($store)['secondary_categories'] ?? [];
    }

    public function getPotentialCatalogChoices(string $store): array
    {
        return $this->params->get($store)['potential_catalog'] ?? [];
    }

    public function getOtherStoresRatingChoices(string $store): array
    {
        return $this->params->get($store)['other_stores_rating'] ?? [];
    }

    public function getOtherStoresListChoices(string $store): array
    {
        return $this->params->get($store)['other_stores'] ?? [];
    }

    public function getMarketingInvestChoices(string $store): array
    {
        return $this->params->get($store)['marketing_invest'] ?? [];
    }

    public function getIntegrationFlagChoices(string $store): array
    {
        return $this->params->get($store)['integration_flag'] ?? [];
    }

    public function getWarehouseModeChoices(string $store): array
    {
        return $this->params->get($store)['warehouse_mode'] ?? [];
    }

    public function getWarehouseCities(string $store): array
    {
        return $this->params->get($store)['warehouse_cities'];
    }

    public function getLegalCountries(string $store): array
    {
        return $this->params->get($store)['countries'];
    }

    public function getOpportunityCountries(): array
    {
        return $this->params->get('opportunity_countries');
    }

    public function getInternationalPaymentMethods(): array
    {
        return $this->params->get('international_payment_methods');
    }
}
