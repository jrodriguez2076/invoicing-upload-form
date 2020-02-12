<?php

declare(strict_types=1);

namespace App\Event\Listener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class RequestIdListener
{
    public function onKernelRequest(RequestEvent $event): void
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

    public function onKernelResponse(ResponseEvent $event): void
    {
        $event->getResponse()->headers->set('X-Request-I    D', $event->getRequest()->headers->get('X-Request-ID'));
    }
}
