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
     * @var float|null
     */
    private ?float $pay_patient = null;

    /**
     * @var float|null
     */
    private ?float $return_pay_patient = null;

    /**
     * @var float|null
     */
    private ?float $service_price = null;

    /**
     * @var float|null
     */
    private ?float $difference_price = null;

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
        $dto->setPayPatient($data['pay_patient'] ?? 0);
        $dto->setReturnPayPatient($data['return_pay_patient'] ?? 0);
        $dto->setServicePrice($data['service_price'] ?? 0);
        $dto->setDifferencePrice($data['difference_price'] ?? 0);
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
    public function getServiceId(): array
    {
        return $this->service_id;
    }

    /**
     * @param array $service_id
     */
    public function setServiceId(array $service_id): void
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
     * @return float|null
     */
    public function getPayPatient(): ?float
    {
        return $this->pay_patient;
    }

    /**
     * @param float|null $pay_patient
     */
    public function setPayPatient(?float $pay_patient): void
    {
        $this->pay_patient = $pay_patient;
    }

    /**
     * @return float|null
     */
    public function getReturnPayPatient(): ?float
    {
        return $this->return_pay_patient;
    }

    /**
     * @param float|null $return_pay_patient
     */
    public function setReturnPayPatient(?float $return_pay_patient): void
    {
        $this->return_pay_patient = $return_pay_patient;
    }

    /**
     * @return float|null
     */
    public function getServicePrice(): ?float
    {
        return $this->service_price;
    }

    /**
     * @param float|null $service_price
     */
    public function setServicePrice(?float $service_price): void
    {
        $this->service_price = $service_price;
    }

    /**
     * @return float|null
     */
    public function getDifferencePrice(): ?float
    {
        return $this->difference_price;
    }

    /**
     * @param float|null $difference_price
     */
    public function setDifferencePrice(?float $difference_price): void
    {
        $this->difference_price = $difference_price;
    }
}
