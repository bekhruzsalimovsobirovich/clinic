<?php

namespace App\Domain\Appointments\DTO;

use App\Domain\Appointments\Models\Appointment;

class UpdateAppointmentDTO
{
    private string $date;

    /**
     * @var Appointment
     */
    private Appointment $appointment;

    /**
     * @param array $data
     * @return UpdateAppointmentDTO
     */
    public static function fromArray(array $data): UpdateAppointmentDTO
    {
        $dto = new self();
        $dto->setDate($data['date']);
        $dto->setAppointment($data['appointment']);

        return $dto;
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

    /**
     * @return Appointment
     */
    public function getAppointment(): Appointment
    {
        return $this->appointment;
    }

    /**
     * @param Appointment $appointment
     */
    public function setAppointment(Appointment $appointment): void
    {
        $this->appointment = $appointment;
    }
}
