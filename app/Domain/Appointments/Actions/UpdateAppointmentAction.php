<?php

namespace App\Domain\Appointments\Actions;

use App\Domain\Appointments\DTO\StoreAppointmentDTO;
use App\Domain\Appointments\DTO\UpdateAppointmentDTO;
use App\Domain\Appointments\Models\Appointment;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateAppointmentAction
{
    /**
     * @param UpdateAppointmentDTO $dto
     * @return Appointment
     * @throws Exception
     */
    public function execute(UpdateAppointmentDTO $dto): Appointment
    {
        DB::beginTransaction();
        try {
            $appointment = $dto->getAppointment();
            $appointment->date = $dto->getDate();
            $appointment->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $appointment;
    }
}
