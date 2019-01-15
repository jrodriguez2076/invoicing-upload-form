<?php

declare(strict_types=1);

namespace App\Entity;

class Contact
{
    /**
     * @var GeneralInfo
     */
    protected $generalInfo;


    public function getGeneralInfo(): ?GeneralInfo
    {
        return $this->generalInfo;
    }

    public function setGeneralInfo(?string $generalInfo): void
    {
        $this->generalInfo = $generalInfo;
    }
}
