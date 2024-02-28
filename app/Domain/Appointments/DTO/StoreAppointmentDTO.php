<?php

namespace App\Domain\Appointments\DTO;

class StoreAppointmentDTO
{
    private string $full_name;
    private string $phone;
    private string $date;

    /**
     * @param array $data
     * @return StoreAppointmentDTO
     */
    public static function fromArray(array $data): StoreAppointmentDTO
    {
        $dto = new self();
        $dto->setFullName($data['full_name']);
        $dto->setPhone($data['phone']);
        $dto->setDate($data['date']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}
