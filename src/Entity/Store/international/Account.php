<?php

declare(strict_types=1);

namespace App\Entity\Store\international;

class Account extends \App\Entity\Account
{
    public function getWarehouseCity(): string
    {
        return $this->warehouseCity . '|' . $this->getWarehouseCity2();
    }
}
