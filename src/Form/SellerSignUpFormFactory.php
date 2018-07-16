<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Factory\SellerSignUpArgentinaForm;
use App\Form\Factory\SellerSignUpChileForm;
use App\Form\Factory\SellerSignUpColombiaForm;
use App\Form\Factory\SellerSignUpEcuadorForm;
use App\Form\Factory\SellerSignUpInternationalForm;
use App\Form\Factory\SellerSignUpMexicoForm;
use App\Form\Factory\SellerSignUpPeruForm;

class SellerSignUpFormFactory
{
    /**
     * @var array
     */
    protected const LOCALE_FORM_MAP = [
        'ar' => SellerSignUpArgentinaForm::class,
        'cl' => SellerSignUpChileForm::class,
        'co' => SellerSignUpColombiaForm::class,
        'ec' => SellerSignUpEcuadorForm::class,
        'mx' => SellerSignUpMexicoForm::class,
        'pe' => SellerSignUpPeruForm::class,
    ];

    public static function fromStore(string $store): string
    {
        return static::LOCALE_FORM_MAP[$store] ?? SellerSignUpInternationalForm::class;
    }
}
