<?php

namespace App\Domain\Payments\DTO;

class StorePaymentDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var array
     */
    private array $service_id;

    /**
     * @var int|null
     */
    private ?int $status = null;

    /**
     * @var int|null
     */
    private ?int $return_status = null;

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
        $dto->setServiceId($data['service_id']);
        $dto->setStatus($data['status'] ?? 0);
        $dto->setReturnStatus($data['return_status'] ?? 0);
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
     * @return array|null
     */
    public function getServiceId(): ?array
    {
        return $this->service_id;
    }

    /**
     * @param array|null $service_id
     */
    public function setServiceId(?array $service_id): void
    {
        $this->service_id = $service_id;
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
     * @return int|null
     */
    public function getReturnStatus(): ?int
    {
        return $this->return_status;
    }

    /**
     * @param int|null $return_status
     */
    public function setReturnStatus(?int $return_status): void
    {
        $this->return_status = $return_status;
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
