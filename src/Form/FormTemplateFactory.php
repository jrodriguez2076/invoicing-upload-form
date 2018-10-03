<?php

declare(strict_types=1);

namespace App\Form;

class FormTemplateFactory
{
    /**
     * @var array
     */
    protected const LOCALE_FORM_MAP = [
        'ar' => 'sellerSignUp.html.twig',
        'cl' => 'sellerSignUp.html.twig',
        'co' => 'sellerSignUp.html.twig',
        'ec' => 'sellerSignUp.html.twig',
        'mx' => 'sellerSignUp.html.twig',
        'pe' => 'sellerSignUp.html.twig',
    ];

    /**
     * @var array
     */
    protected const LOCALE_SLIM_FORM_MAP = [
        'ar' => 'sellerSignUp.html.twig',
        'cl' => 'sellerSignUp.html.twig',
        'co' => 'sellerSignUp.html.twig',
        'ec' => 'sellerSignUp.html.twig',
        'mx' => 'sellerSignUp.html.twig',
        'pe' => 'sellerSignUp.html.twig',
    ];

    public static function fromStore(string $store, $slim = false): string
    {
        if ($slim) {
            return static::LOCALE_SLIM_FORM_MAP[$store] ?? 'sellerSignUpSlim.html.twig';
        }

        return static::LOCALE_FORM_MAP[$store] ?? 'sellerSignUpInternational.html.twig';
    }
}
