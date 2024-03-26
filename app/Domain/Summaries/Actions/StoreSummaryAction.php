<?php

namespace App\Domain\Summaries\Actions;

use App\Domain\Summaries\DTO\StoreSummaryDTO;
use App\Domain\Summaries\Models\Summary;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreSummaryAction
{
    /**
     * @param StoreSummaryDTO $dto
     * @return Summary
     * @throws Exception
     */
    public function execute(StoreSummaryDTO $dto): Summary
    {
        DB::beginTransaction();
        try {
            $summary = new Summary();
            $summary->patient_id = $dto->getPatientId();
            $summary->body = $dto->getBody();
            $summary->files = $dto->getFiles();
            $summary->mkb = $dto->getMkb();
            $summary->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $summary;
    }
}
