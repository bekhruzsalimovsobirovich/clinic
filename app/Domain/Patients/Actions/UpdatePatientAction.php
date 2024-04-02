<?php

namespace App\Domain\Patients\Actions;

use App\Domain\Patients\DTO\StorePatientDTO;
use App\Domain\Patients\DTO\UpdatePatientDTO;
use App\Domain\Patients\Models\Patient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UpdatePatientAction
{
    /**
     * @param UpdatePatientDTO $dto
     * @return Patient
     * @throws Exception
     */
    public function execute(UpdatePatientDTO $dto): Patient
    {
        DB::beginTransaction();
        try {
            $patient = $dto->getPatient();
            $patient->user_id = $dto->getUserId();
            $patient->agent_id = $dto->getAgentId();
            $patient->full_name = $dto->getFullName();
            $patient->workplace = $dto->getWorkplace();
            $patient->birthday = $dto->getBirthday();
            $patient->province_city = $dto->getProvinceCity();
            $patient->address = $dto->getAddress();
            $patient->job = $dto->getJob();
            $patient->phone = $dto->getPhone();
            $patient->description = $dto->getDescription();

            if ($dto->getAvatar() !== null) {
                File::delete('storage/files/patients/images/' . $dto->getPatient()->avatar);
                $image = $dto->getAvatar();
                $filename = Str::random(4) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/files/patients/images', $filename);
                $patient->avatar = $filename;
                $patient->avatar_path = url('storage/files/patients/images/' . $filename);
            }

//            if ($dto->getAvatar()) {
//                File::delete(public_path('images/patients/'.$dto->getPatient()->avatar));
//                $file = $dto->getAvatar();
//                $extension = $file->getClientOriginalExtension();
//                $filename = time() . '.' . $extension;
//                $file->move('images/patients/', $filename);
//                $patient->avatar = $filename;
//                $patient->avatar_path = url('images/patients/' . $filename);
//            }

            $patient->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $patient;
    }
}
