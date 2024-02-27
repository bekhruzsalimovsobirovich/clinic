<?php

namespace App\Domain\Agents\Actions;

use App\Domain\Agents\DTO\StoreAgentDTO;
use App\Domain\Agents\DTO\UpdateAgentDTO;
use App\Domain\Agents\Models\Agent;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateAgentAction
{
    public function execute(UpdateAgentDTO $dto)
    {
        DB::beginTransaction();
        try {
            $agent = $dto->getAgent();
            $agent->full_name = $dto->getFullName();
            $agent->phone = $dto->getPhone();
            $agent->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $agent;
    }
}
