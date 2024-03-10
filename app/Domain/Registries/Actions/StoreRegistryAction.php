<?php

namespace App\Domain\Registries\Actions;

use App\Domain\Registries\DTO\StoreRegistryDTO;
use App\Domain\Registries\Models\Registry;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreRegistryAction
{
    /**
     * @param StoreRegistryDTO $dto
     * @return Registry
     * @throws Exception
     */
    public function execute(StoreRegistryDTO $dto): Registry
    {
        DB::beginTransaction();
        try {
            $registry = new Registry();
            $registry->patient_id = $dto->getPatientId();
            $registry->data = $dto->getData();
            $registry->save();
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $registry;
    }
}
