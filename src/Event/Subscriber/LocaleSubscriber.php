<?php

declare(strict_types=1);

namespace App\Event\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var array
     */
    protected $localeMap = [
        'ar' => 'es_AR',
        'cl' => 'es_CL',
        'co' => 'es_CO',
        'ec' => 'es_EC',
        'mx' => 'es_MX',
        'pe' => 'es_PE',
        'int' => 'en_US',
    ];

    private $defaultLocale;

    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event): void
    {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            $store = $request->attributes->get('store', $this->defaultLocale);
            $locale = $this->getLocaleFromStore($store);
            $request->setLocale($locale);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            // must be registered before (i.e. with a higher priority than) the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }

    protected function getLocaleFromStore(string $store): string
    {
        return $this->localeMap[$store] ?? $this->defaultLocale;
    }
}
