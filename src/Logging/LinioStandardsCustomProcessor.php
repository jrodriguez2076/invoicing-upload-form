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
        // Ensure we have a request (maybe we're in a console command)
        if (!$this->requestStack->getCurrentRequest()) {
            $record['extra']['request_id'] = uniqid('', true);
            $record['extra']['store'] = 'UNKNOWN';

            return $record;
        }

        $request = $this->requestStack->getCurrentRequest();

        $record['extra']['request_id'] = $request->headers->get('X-Request-ID', uniqid('', true));
        $record['extra']['store'] = $request->getRequestUri() != '/' ? trim($request->getRequestUri(), '/') : 'UNKNOWN';

        return $record;
    }
}
