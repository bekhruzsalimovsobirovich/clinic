<?php

namespace App\Domain\Agents\DTO;

class StoreAgentDTO
{
    /**
     * @var string
     */
    private string $full_name;

    /**
     * @var string
     */
    private string $phone;

    /**
     * @param array $data
     * @return StoreAgentDTO
     */
    public static function fromArray(array $data): StoreAgentDTO
    {
        $dto = new self();
        $dto->setFullName($data['full_name']);
        $dto->setPhone($data['phone']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }
}
