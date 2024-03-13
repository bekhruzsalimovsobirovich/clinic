<?php

namespace App\Domain\UserPatients\Actions;

use App\Domain\UserPatients\DTO\StoreUserPatientDTO;
use App\Domain\UserPatients\Models\UserPatient;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreUserPatientAction
{
    /**
     * @param StoreUserPatientDTO $dto
     * @return UserPatient
     * @throws Exception
     */
    public function execute(StoreUserPatientDTO $dto): UserPatient
    {
        DB::beginTransaction();
        try {
            $user_patient = new UserPatient();
            $user_patient->user_id = $dto->getUserId();
            $user_patient->patient_id = $dto->getPatientId();
            $user_patient->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $user_patient;
    }
}
