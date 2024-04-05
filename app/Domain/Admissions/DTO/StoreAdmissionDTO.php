<?php

namespace App\Domain\Admissions\DTO;

class StoreAdmissionDTO
{
    /**
     * @var int
     */
    private int $user_id;

    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var array|null
     */
    private ?array $admissions = null;

    /**
     * @var int|null
     */
    private ?int $status = 0;

    /**
     * @param array $data
     * @return StoreAdmissionDTO
     */
    public static function fromArray(array $data): StoreAdmissionDTO
    {
        $dto = new self();
        $dto->setUserId($data['user_id']);
        $dto->setPatientId($data['patient_id']);
        $dto->setAdmissions($data['admissions'] ?? null);
        $dto->setStatus($data['status'] ?? 1);

        return $dto;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
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
     * @return array|null
     */
    public function getAdmissions(): ?array
    {
        return $this->admissions;
    }

    /**
     * @param array|null $admissions
     */
    public function setAdmissions(?array $admissions): void
    {
        $this->admissions = $admissions;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }
}
