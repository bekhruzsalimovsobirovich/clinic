<?php

namespace App\Domain\Admissions\Actions;

use App\Domain\Admissions\DTO\StoreAdmissionDTO;
use App\Domain\Admissions\Models\Admission;
use Exception;
use Illuminate\Support\Facades\DB;

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
//            $admission = Admission::query()
//                ->where('user_id', $dto->getUserId())
//                ->where('patient_id', $dto->getPatientId())
//                ->first();

            $admission = Admission::query()->find($dto->getAdmissionId());
            if ($admission != null) {
                $admission->admissions = array_merge($admission->admissions, $dto->getAdmissions());
                $admission->status = $dto->getStatus() ?? $admission->status;
                $admission->update();
            } else {
                $admission = new Admission();
                $admission->user_id = $dto->getUserId();
                $admission->patient_id = $dto->getPatientId();
                $admission->admissions = $dto->getAdmissions();
                $admission->status = $dto->getStatus();
                $admission->save();
            }
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $admission;
    }
}
