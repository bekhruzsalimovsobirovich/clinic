<?php

namespace App\Domain\Illnesses\DTO;

class StoreIllnessDTO
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $code;

    /**
     * @param array $data
     * @return StoreIllnessDTO
     */
    public static function fromArray(array $data): StoreIllnessDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setCode($data['code']);

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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }
}
