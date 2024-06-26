<?php

namespace App\Domain\Payments\DTO;

class StorePaymentDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var int
     */
    private int $admission_id;

    /**
     * @var int|null
     */
    private ?int $status = null;

    /**
     * @var array|null
     */
    private ?array $pays = null;

    /**
     * @param array $data
     * @return StorePaymentDTO
     */
    public static function fromArray(array $data): StorePaymentDTO
    {
        $dto = new self();
        $dto->setPatientId($data['patient_id']);
        $dto->setAdmissionId($data['admission_id']);
        $dto->setStatus($data['status'] ?? 0);
        $dto->setPays($data['pays'] ?? null);
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
     * @return int
     */
    public function getAdmissionId(): int
    {
        return $this->admission_id;
    }

    /**
     * @param int $admission_id
     */
    public function setAdmissionId(int $admission_id): void
    {
        $this->admission_id = $admission_id;
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

    /**
     * @return array|null
     */
    public function getPays(): ?array
    {
        return $this->pays;
    }

    /**
     * @param array|null $pays
     */
    public function setPays(?array $pays): void
    {
        $this->pays = $pays;
    }
}
