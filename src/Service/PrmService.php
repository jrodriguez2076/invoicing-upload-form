<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\PrmAdapter;
use App\Entity\Contact;
use App\Exception\PrmException;

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

    /**
     * @throws PrmException
     */
    public function createContact(Contact $contact): void
    {
        $this->adapter->createContact($contact);
    }
}
