<?php

declare(strict_types=1);

namespace App\Entity\Store\international;

use App\Entity\Opportunity as OpportunityEntity;
use function sprintf;

class Opportunity extends OpportunityEntity
{
    /**
     * @var string
     */
    protected $brand4 = '';

    /**
     * @var string
     */
    protected $brand5 = '';

    public function getBrand3(): ?string
    {
        return sprintf('%s|%s|%s', $this->brand3, $this->brand4, $this->brand5);
    }

    public function getBrand4(): ?string
    {
        return $this->brand4;
    }

    public function setBrand4(?string $brand4): void
    {
        $this->brand4 = $brand4;
    }

    public function getBrand5(): ?string
    {
        return $this->brand5;
    }

    public function setBrand5(?string $brand5): void
    {
        $this->brand5 = $brand5;
    }
}
