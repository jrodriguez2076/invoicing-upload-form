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
        return $this->params->get('contributor_types')[$store] ?? [];
    }

    public function getMainCategoriesChoices(string $store): array
    {
        return $this->params->get('main_categories')[$store] ?? [];
    }

    public function getSecondaryCategoriesChoices(string $store): array
    {
        return $this->params->get('secondary_categories')[$store] ?? [];
    }

    public function getPotentialCatalogChoices(string $store): array
    {
        return $this->params->get('potential_catalog')[$store] ?? [];
    }

    public function getOtherStoresRatingChoices(string $store): array
    {
        return $this->params->get('other_stores_rating')[$store] ?? [];
    }

    public function getOtherStoresListChoices(string $store): array
    {
        return $this->params->get('other_stores')[$store] ?? [];
    }

    public function getMarketingInvestChoices(string $store): array
    {
        return $this->params->get('marketing_invest')[$store] ?? [];
    }

    public function getIntegrationFlagChoices(string $store): array
    {
        return $this->params->get('integration_flag')[$store] ?? [];
    }

    public function getWarehouseModeChoices(string $store): array
    {
        return $this->params->get('warehouse_mode')[$store] ?? [];
    }

    public function getWarehouseCities(string $store): array
    {
        return $this->params->get('warehouse_cities')[$store];
    }
}
