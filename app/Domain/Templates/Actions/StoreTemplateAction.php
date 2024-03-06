<?php

namespace App\Domain\Templates\Actions;

use App\Domain\Templates\DTO\StoreTemplateDTO;
use App\Domain\Templates\Models\Template;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreTemplateAction
{
    /**
     * @param StoreTemplateDTO $dto
     * @return Template
     * @throws Exception
     */
    public function execute(StoreTemplateDTO $dto): Template
    {
        DB::beginTransaction();
        try {
            $template = new Template();
            $template->user_id = $dto->getUserId();
            $template->patient_id = $dto->getPatientId();
            $template->body = $dto->getBody();
            $template->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $template;
    }
}
