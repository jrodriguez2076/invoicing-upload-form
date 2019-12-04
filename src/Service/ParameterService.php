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
        $store = $this->validateStore($store);

        return $this->params->get($store)['invoincing_type'] ?? [];
    }

    public function getOriginChoices(string $store): array
    {
        $store = $this->validateStore($store);

        return $this->params->get($store)['origin'] ?? [];
    }

    public function getPackagingTypeChoices(string $store): array
    {
        $store = $this->validateStore($store);

        return $this->params->get($store)['packaging_types'] ?? [];
    }

    public function getShippingCompanyChoices(string $store): array
    {
        $store = $this->validateStore($store);

        return $this->params->get($store)['shipping_companies'] ?? [];
    }

    public function getGenericAccountEmail(string $store): string
    {
        $store = $this->validateStore($store);

        return $this->params->get($store)['email'] ?? '';
    }

    protected function validateStore(string $store): string
    {
        if ($this->params->has($store)) {
            return $store;
        }

        return  $this->params->get('default_store');
    }
}
