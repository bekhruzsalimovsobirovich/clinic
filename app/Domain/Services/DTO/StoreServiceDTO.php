<?php

namespace App\Domain\Services\DTO;

class StoreServiceDTO
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
     * @param array $data
     * @return StoreServiceDTO
     */
    public static function fromArray(array $data): StoreServiceDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setPrice($data['price']);

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
}
