<?php

declare(strict_types=1);

namespace App\Entity\Store\pe;

use App\Entity\Account as AccountEntity;

class Account extends AccountEntity
{
    public function getWarehouseAddress(): string
    {
        return sprintf(
            '%s|%s|%s',
            $this->warehouseAddress,
            $this->getWarehouseAddressExtraData(),
            $this->getWarehouseAddressExtraData2()
        );
    }
}
