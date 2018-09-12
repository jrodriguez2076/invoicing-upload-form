<?php

declare(strict_types=1);

namespace App\Logging;

use Symfony\Component\HttpFoundation\RequestStack;

class RequestIdMonologProcessor
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
            $record['extra']['request_id'] = bin2hex(random_bytes(10));

            return $record;
        }

        $record['extra']['request_id'] = $this->requestStack->getMasterRequest()->headers->get('X-Request-ID');
        $record['extra']['store'] = $this->requestStack->getMasterRequest()->get('store');

        return $record;
    }
}
