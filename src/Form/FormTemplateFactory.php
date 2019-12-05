<?php

declare(strict_types=1);

namespace App\Form;

class FormTemplateFactory
{
    /**
     * @var array
     */
    protected const LOCALE_FORM_MAP = [
        'ar' => 'contact.html.twig',
        'cl' => 'contact.html.twig',
        'co' => 'contact.html.twig',
        'ec' => 'contact.html.twig',
        'mx' => 'contact.html.twig',
        'pe' => 'contact.html.twig',
        'default' => 'contact.html.twig',
    ];

    public static function fromStore(string $store): string
    {
        if (!array_key_exists($store, self::LOCALE_FORM_MAP)) {
            return static::LOCALE_FORM_MAP['default'];
        }

        return static::LOCALE_FORM_MAP[$store];
    }
}
