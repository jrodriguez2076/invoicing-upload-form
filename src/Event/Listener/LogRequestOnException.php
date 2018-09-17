<?php

declare(strict_types=1);

namespace App\Event\Listener;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

class LogRequestOnException
{
    const EXCLUDED_HEADERS = ['cookie'];

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        $exception = $event->getException();

        if ($this->ignoreException($exception)) {
            return;
        }

        $request = $event->getRequest();
        $this->logger->debug(sprintf('Logged request for "%s"', get_class($exception)), [
            'request' => [
                'headers' => $this->filterHeaders($request->headers->all()),
                'query' => $request->query->all(),
                'body' => $request->request->all(),
            ],
        ]);
    }

    private function ignoreException(Throwable $exception): bool
    {
        return $exception instanceof HttpExceptionInterface;
    }

    private function filterHeaders(array $headers): array
    {
        foreach (self::EXCLUDED_HEADERS as $header) {
            unset($headers[$header]);
        }

        return $headers;
    }
}
