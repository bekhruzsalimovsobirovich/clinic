<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\DTO\StoreAppointmentDTO;
use App\Domain\Appointments\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreAppointmentAction
{
    /**
     * @param StoreAppointmentDTO $dto
     * @return Appointment
     * @throws Exception
     */
    public function execute(StoreAppointmentDTO $dto): Appointment
    {
        DB::beginTransaction();
        try {
            $appointment = new Appointment();
            $appointment->full_name = $dto->getFullName();
            $appointment->phone = $dto->getPhone();
            $appointment->date = $dto->getDate();
            $appointment->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $appointment;
    }
}
