<?php

namespace App\Domain\Admissions\DTO;

class StoreAdmissionDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var array
     */
    private array $admissions;

    /**
     * @var int
     */
    private int $status;

    /**
     * @param array $data
     * @return StoreAdmissionDTO
     */
    public static function fromArray(array $data): StoreAdmissionDTO
    {
        $dto = new self();
        $dto->setPatientId($data['patient_id']);
        $dto->setTitle($data['title']);
        $dto->setAdmissions($data['admissions']);
        $dto->setStatus($data['status']);

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
    public function getAdmissions(): array
    {
        return $this->admissions;
    }

    /**
     * @param array $admissions
     */
    public function setAdmissions(array $admissions): void
    {
        $this->admissions = $admissions;
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
