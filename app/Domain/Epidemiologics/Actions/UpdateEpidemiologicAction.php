<?php

namespace App\Domain\Epidemiologics\Actions;

use App\Domain\Epidemiologics\DTO\StoreEpidemiologicDTO;
use App\Domain\Epidemiologics\DTO\UpdateEpidemiologicDTO;
use App\Domain\Epidemiologics\Models\Epidemiologic;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateEpidemiologicAction
{
    /**
     * @param UpdateEpidemiologicDTO $dto
     * @return Epidemiologic
     * @throws Exception
     */
    public function execute(UpdateEpidemiologicDTO $dto): Epidemiologic
    {
        DB::beginTransaction();
        try {
            $epidemiologic = $dto->getEpidemiologic();
            $epidemiologic->title = $dto->getTitle();
            $epidemiologic->update();
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $epidemiologic;
    }
}
