<?php

namespace App\Domain\Epidemiologics\Actions;

use App\Domain\Epidemiologics\DTO\StoreEpidemiologicDTO;
use App\Domain\Epidemiologics\Models\Epidemiologic;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreEpidemiologicAction
{
    /**
     * @param StoreEpidemiologicDTO $dto
     * @return Epidemiologic
     * @throws Exception
     */
    public function execute(StoreEpidemiologicDTO $dto): Epidemiologic
    {
        DB::beginTransaction();
        try {
            $epidemiologic = new Epidemiologic();
            $epidemiologic->title = $dto->getTitle();
            $epidemiologic->save();
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $epidemiologic;
    }
}
