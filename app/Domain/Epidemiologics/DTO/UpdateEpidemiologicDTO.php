<?php

namespace App\Domain\Epidemiologics\DTO;

use App\Domain\Epidemiologics\Models\Epidemiologic;

class UpdateEpidemiologicDTO
{
    private string $title;

    /**
     * @var Epidemiologic
     */
    private Epidemiologic $epidemiologic;

    /**
     * @param array $data
     * @return UpdateEpidemiologicDTO
     */
    public static function fromArray(array $data): UpdateEpidemiologicDTO
    {
        $dto = new self();
        $dto->setTitle($data['title']);
        $dto->setEpidemiologic($data['epidemiologic']);

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
     * @return Epidemiologic
     */
    public function getEpidemiologic(): Epidemiologic
    {
        return $this->epidemiologic;
    }

    /**
     * @param Epidemiologic $epidemiologic
     */
    public function setEpidemiologic(Epidemiologic $epidemiologic): void
    {
        $this->epidemiologic = $epidemiologic;
    }
}
