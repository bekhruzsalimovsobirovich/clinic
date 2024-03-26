<?php

namespace App\Domain\Files\DTO;

class StoreFileDTO
{
    /**
     * @var array
     */
    private array $title;


    /**
     * @param array $data
     * @return StoreFileDTO
     */
    public static function fromArray(array $data): StoreFileDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);

        return $dto;
    }

    /**
     * @return array
     */
    public function getTitle(): array
    {
        return $this->title;
    }

    /**
     * @param array $title
     */
    public function setTitle(array $title): void
    {
        $this->title = $title;
    }
}
