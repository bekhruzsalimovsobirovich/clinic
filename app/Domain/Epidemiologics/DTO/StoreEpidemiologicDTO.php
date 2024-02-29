<?php

namespace App\Domain\Epidemiologics\DTO;

class StoreEpidemiologicDTO
{
    private string $title;

    /**
     * @param array $data
     * @return StoreEpidemiologicDTO
     */
    public static function fromArray(array $data): StoreEpidemiologicDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);

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
}
