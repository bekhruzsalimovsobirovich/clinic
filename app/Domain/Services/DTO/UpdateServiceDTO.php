<?php

namespace App\Domain\Services\DTO;

use App\Domain\Services\Models\Service;

class UpdateServiceDTO
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var int
     */
    private int $checked;

    /**
     * @var Service
     */
    private Service $service;

    /**
     * @param array $data
     * @return UpdateServiceDTO
     */
    public static function fromArray(array $data): UpdateServiceDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setPrice($data['price']);
        $dto->setService($data['service']);
        $dto->setChecked($data['checked']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return Service
     */
    public function getService(): Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService(Service $service): void
    {
        $this->service = $service;
    }

    /**
     * @return int
     */
    public function getChecked(): int
    {
        return $this->checked;
    }

    /**
     * @param int $checked
     */
    public function setChecked(int $checked): void
    {
        $this->checked = $checked;
    }
}
