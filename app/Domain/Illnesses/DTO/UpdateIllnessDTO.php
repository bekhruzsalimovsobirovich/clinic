<?php

namespace App\Domain\Illnesses\DTO;

use App\Domain\Illnesses\Models\Illness;

class UpdateIllnessDTO
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
     * @var Illness
     */
    private Illness $illness;

    /**
     * @param array $data
     * @return UpdateIllnessDTO
     */
    public static function fromArray(array $data): UpdateIllnessDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setCode($data['code']);
        $dto->setIllness($data['illness']);

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

    /**
     * @return Illness
     */
    public function getIllness(): Illness
    {
        return $this->illness;
    }

    /**
     * @param Illness $illness
     */
    public function setIllness(Illness $illness): void
    {
        $this->illness = $illness;
    }
}
