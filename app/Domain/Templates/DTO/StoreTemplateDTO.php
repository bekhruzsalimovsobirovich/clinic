<?php

namespace App\Domain\Templates\DTO;

class StoreTemplateDTO
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
     * @var string
     */
    private string $body;

    /**
     * @param array $data
     * @return StoreTemplateDTO
     */
    public static function fromArray(array $data): StoreTemplateDTO
    {
        $dto = new self();
        $dto->setUserId($data['user_id']);
        $dto->setPatientId($data['patient_id']);
        $dto->setBody($data['body']);

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
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}
