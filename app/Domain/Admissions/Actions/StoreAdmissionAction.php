<?php

namespace App\Domain\Admissions\Actions;

use App\Domain\Admissions\DTO\StoreAdmissionDTO;
use App\Domain\Admissions\Models\Admission;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StoreAdmissionAction
{
    /**
     * @param StoreAdmissionDTO $dto
     * @return Admission
     * @throws Exception
     */
    public function execute(StoreAdmissionDTO $dto): Admission
    {
        DB::beginTransaction();
        try {
            $admission = new Admission();
            $admission->patient_id = $dto->getPatientId();
            $admission->uuid = Str::uuid();
            $admission->admissions = $dto->getAdmissions();
            $admission->status = $dto->getStatus();
            $admission->save();
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $admission;
    }
}
