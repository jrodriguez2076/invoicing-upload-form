<?php

declare(strict_types=1);

namespace App\Entity\Store\ar;

use App\Entity\Account as AccountEntity;

class Account extends AccountEntity
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
