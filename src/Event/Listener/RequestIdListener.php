<?php

declare(strict_types=1);

namespace App\Event\Listener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestIdListener
{
    public function onKernelRequest(GetResponseEvent $event): void
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $headers = $event->getRequest()->headers;

        if ($headers->has('X-Request-ID')) {
            return;
        }

        $headers->set('X-Request-ID', uniqid());
    }

    public function onKernelResponse(FilterResponseEvent $event): void
    {
        $event->getResponse()->headers->set('X-Request-ID', $event->getRequest()->headers->get('X-Request-ID'));
    }
}
