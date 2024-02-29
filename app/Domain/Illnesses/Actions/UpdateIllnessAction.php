<?php

namespace App\Domain\Illnesses\Actions;

use App\Domain\Illnesses\DTO\StoreIllnessDTO;
use App\Domain\Illnesses\DTO\UpdateIllnessDTO;
use App\Domain\Illnesses\Models\Illness;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateIllnessAction
{
    /**
     * @param UpdateIllnessDTO $dto
     * @return Illness
     * @throws Exception
     */
    public function execute(UpdateIllnessDTO $dto): Illness
    {
        DB::beginTransaction();
        try {
            $illness = $dto->getIllness();
            $illness->title = $dto->getTitle();
            $illness->code = $dto->getCode();
            $illness->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        return $illness;
    }
}
