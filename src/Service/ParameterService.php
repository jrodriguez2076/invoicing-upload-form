<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ParameterService
{
    /**
     * @var ParameterBagInterface
     */
    protected $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function getInvoicingTypeChoices(string $store): array
    {
        $storeId = $this->getStoreId($store);

        return $this->params->get($storeId)['invoincing_type'] ?? [];
    }

    public function getOriginChoices(string $store): array
    {
        $storeId = $this->getStoreId($store);

        return $this->params->get($storeId)['origin'] ?? [];
    }

    public function getPackagingTypeChoices(string $store): array
    {
        $storeId = $this->getStoreId($store);

        return $this->params->get($storeId)['packaging_types'] ?? [];
    }

    public function getShippingCompanyChoices(string $store): array
    {
        $storeId = $this->getStoreId($store);

        return $this->params->get($storeId)['shipping_companies'] ?? [];
    }

    public function getGenericAccountEmail(string $store): string
    {
        $storeId = $this->getStoreId($store);

        return $this->params->get($storeId)['email'] ?? '';
    }

    protected function getStoreId(string $store): string
    {
        if ($this->params->has($store)) {
            return $store;
        }

        return  $this->params->get('default_store');
    }
}
