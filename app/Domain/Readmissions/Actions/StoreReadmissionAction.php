<?php

namespace App\Domain\Readmissions\Actions;

use App\Domain\Readmissions\DTO\StoreReadmissonDTO;
use App\Domain\Readmissions\Models\Readmission;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreReadmissionAction
{
    /**
     * @param StoreReadmissonDTO $dto
     * @return Readmission
     * @throws Exception
     */
    public function execute(StoreReadmissonDTO $dto): Readmission
    {
        DB::beginTransaction();
        try {
            $readmission = new Readmission();
            $readmission->patient_id = $dto->getPatientId();
            $readmission->date = $dto->getDate();
            $readmission->status = $dto->getStatus();
            $readmission->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $readmission;
    }
}
