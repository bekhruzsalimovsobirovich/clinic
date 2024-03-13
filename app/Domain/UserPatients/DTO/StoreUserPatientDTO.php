<?php

namespace App\Domain\UserPatients\DTO;

class StoreUserPatientDTO
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
     * @param array $data
     * @return StoreUserPatientDTO
     */
    public static function fromArray(array $data): StoreUserPatientDTO
    {
        $dto = new self();
        $dto->setUserId($data['user_id']);
        $dto->setPatientId($data['patient_id']);

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
}
