<?php

namespace App\Domain\Registries\DTO;

class StoreRegistryDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var array
     */
    private array $data;

    /**
     * @param array $data
     * @return StoreRegistryDTO
     */
    public static function fromArray(array $data): StoreRegistryDTO
    {
        $dto = new self();
        $dto->setPatientId($data['patient_id']);
        $dto->setData($data['data']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getPatientId(): int
    {
        return $this->patient_id;
    }

    /**
     * @param int $patient_id
     */
    public function setPatientId(int $patient_id): void
    {
        $this->patient_id = $patient_id;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
