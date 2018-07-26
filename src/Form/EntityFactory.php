<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Store\ar\Account as AccountArgentina;
use App\Entity\Store\cl\Account as AccountChile;
use App\Entity\Store\co\Account as AccountColombia;
use App\Entity\Store\ec\Account as AccountEcuador;
use App\Entity\Store\international\Account as AccountInternational;
use App\Entity\Store\mx\Account as AccountMexico;
use App\Entity\Store\pe\Account as AccountPeru;

class EntityFactory
{
    /**
     * @var array
     */
    protected const LOCALE_ACCOUNT_MAP = [
        'ar' => AccountArgentina::class,
        'cl' => AccountChile::class,
        'co' => AccountColombia::class,
        'ec' => AccountEcuador::class,
        'mx' => AccountMexico::class,
        'pe' => AccountPeru::class,
    ];

    public static function accountEntityFromStore(string $store): string
    {
        return static::LOCALE_ACCOUNT_MAP[$store] ?? AccountInternational::class;
    }
}
