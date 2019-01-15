<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\PrmAdapter;
use App\Entity\Contact;

class PrmService
{
    /**
     * @var PrmAdapter
     */
    protected $adapter;

    public function __construct(PrmAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function processFormData(Contact $contact, string $store): void
    {
    }
}
