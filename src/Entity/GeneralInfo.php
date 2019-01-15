<?php

declare(strict_types=1);

namespace App\Entity;

class GeneralInfo
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $accountName = '';

    /**
     * @var string
     */
    protected $sellerCenterId = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $reason = '';

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(?string $accountName): void
    {
        $this->accountName = $accountName;
    }

    public function getSellerCenterId(): ?string
    {
        return $this->sellerCenterId;
    }

    public function setSellerCenterId(?string $sellerCenterId): void
    {
        $this->sellerCenterId = $sellerCenterId;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }
}
