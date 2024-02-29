<?php

namespace App\Domain\Roles\DTO;

class StoreRoleDTO
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @param array $data
     * @return StoreRoleDTO
     */
    public static function fromArray(array $data): StoreRoleDTO
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
