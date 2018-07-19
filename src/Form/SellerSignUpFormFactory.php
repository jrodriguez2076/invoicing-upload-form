<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Store\ar\SellerSignUpForm as SellerSignUpArgentinaForm;
use App\Form\Store\cl\SellerSignUpForm as SellerSignUpChileForm;
use App\Form\Store\co\SellerSignUpForm as SellerSignUpColombiaForm;
use App\Form\Store\ec\SellerSignUpForm as SellerSignUpEcuadorForm;
use App\Form\Store\international\SellerSignUpForm as SellerSignUpInternationalForm;
use App\Form\Store\mx\SellerSignUpForm as SellerSignUpMexicoForm;
use App\Form\Store\pe\SellerSignUpForm as SellerSignUpPeruForm;

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
