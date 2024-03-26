<?php

namespace App\Domain\Summaries\DTO;

class StoreSummaryDTO
{
    /**
     * @var int
     */
    private int $patient_id;

    /**
     * @var string
     */
    private string $body;

    /**
     * @var array|null
     */
    private ?array $files = null;

    /**
     * @param array $data
     * @return StoreSummaryDTO
     */
    public static function fromArray(array $data): StoreSummaryDTO
    {
        $dto = new self();
        $dto->setPatientId($data['patient_id']);
        $dto->setBody($data['body']);
        $dto->setFiles($data['files'] ?? null);

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

    /**
     * @return array|null
     */
    public function getFiles(): ?array
    {
        return $this->files;
    }

    /**
     * @param array|null $files
     */
    public function setFiles(?array $files): void
    {
        $this->files = $files;
    }
}
