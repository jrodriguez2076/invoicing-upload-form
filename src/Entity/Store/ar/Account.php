<?php

declare(strict_types=1);

namespace App\Entity\Store\ar;

class Account extends \App\Entity\Account
{
    public function getWarehouseCity(): string
    {
        return $this->warehouseCity . '|' . $this->getWarehouseCity2();
    }

    public function getWarehousePostalCode(): string
    {
        return $this->warehousePostalCode . '|' . $this->getWarehouseMode();
    }

    public function getWarehouseAddress2(): string
    {
        return $this->warehouseAddress2 . '|' . $this->getWarehouseAddressExtraData() . '|' . $this->getWarehouseAddressExtraData2();
    }
}
