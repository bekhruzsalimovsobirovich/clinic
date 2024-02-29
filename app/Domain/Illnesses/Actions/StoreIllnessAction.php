<?php

namespace App\Domain\Illnesses\Actions;

use App\Domain\Illnesses\DTO\StoreIllnessDTO;
use App\Domain\Illnesses\Models\Illness;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreIllnessAction
{
    /**
     * @param StoreIllnessDTO $dto
     * @return Illness
     * @throws Exception
     */
    public function execute(StoreIllnessDTO $dto): Illness
    {
        DB::beginTransaction();
        try {
            $illness = new Illness();
            $illness->title = $dto->getTitle();
            $illness->code = $dto->getCode();
            $illness->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $illness;
    }
}
