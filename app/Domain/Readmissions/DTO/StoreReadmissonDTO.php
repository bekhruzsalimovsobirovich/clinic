<?php

namespace App\Domain\Readmissions\DTO;

class StoreReadmissonDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var string
     */
    private string $date;

    /**
     * @var int
     */
    private int $status;

    /**
     * @param array $data
     * @return StoreReadmissonDTO
     */
    public static function fromArray(array $data): StoreReadmissonDTO
    {
        $dto = new self();
        $dto->setPatientId($data['patient_id']);
        $dto->setDate($data['date']);
        $dto->setStatus($data['status']);

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
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
