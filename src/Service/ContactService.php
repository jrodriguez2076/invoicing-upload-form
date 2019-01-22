<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ContactService
{
    /**
     * @var ParameterBagInterface
     */
    protected $params;

    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
}
