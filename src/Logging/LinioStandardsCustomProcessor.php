<?php

declare(strict_types=1);

namespace App\Logging;

use Symfony\Component\HttpFoundation\RequestStack;

class LinioStandardsCustomProcessor
{
    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * @var string
     */
    protected $store;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function __invoke(array $record): array
    {
        $request = $this->requestStack->getCurrentRequest();
        // Ensure we have a request (maybe we're in a console command)
        if (!$request) {
            $record['extra']['request_id'] = $this->generateRequestId();
            $record['extra']['store'] = 'UNKNOWN';

            return $record;
        }

        $record['extra']['request_id'] = $request->headers->get('X-Request-ID', $this->generateRequestId());
        $record['extra']['store'] = $request->getRequestUri() != '/' ? trim($request->getRequestUri(), '/') : 'UNKNOWN';

        return $record;
    }

    private function generateRequestId(): string
    {
        return uniqid('', true);
    }
}
