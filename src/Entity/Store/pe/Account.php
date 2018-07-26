<?php

declare(strict_types=1);

namespace App\Entity\Store\pe;

class Account extends \App\Entity\Account
{
    public function getWarehouseAddress(): string
    {
        return sprintf(
            '%s|%s|%s|%s|%s',
            $this->warehouseAddress,
            $this->getWarehouseAddressExtraData(),
            $this->getWarehouseAddressExtraData2(),
            $this->getWarehouseAddressExtraData3(),
            $this->getWarehouseAddressExtraData4()
        );
    }
}
