<?php

declare(strict_types=1);

namespace App\Form;

use App\Form\Store\ar\ContactForm as ContactArgentinaForm;
use App\Form\Store\cl\ContactForm as ContactChileForm;
use App\Form\Store\co\ContactForm as ContactColombiaForm;
use App\Form\Store\mx\ContactForm as ContactMexicoForm;
use App\Form\Store\pe\ContactForm as ContactPeruForm;

class ContactFormFactory
{
    /**
     * @var array
     */
    protected const LOCALE_FORM_MAP = [
        'ar' => ContactArgentinaForm::class,
        'cl' => ContactChileForm::class,
        'co' => ContactColombiaForm::class,
        'mx' => ContactMexicoForm::class,
        'pe' => ContactPeruForm::class,
    ];

    public static function fromStore(string $store): string
    {
        return static::LOCALE_FORM_MAP[$store];
    }
}
