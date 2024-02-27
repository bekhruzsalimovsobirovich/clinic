<?php

namespace App\Domain\Agents\Actions;

use App\Domain\Agents\DTO\StoreAgentDTO;
use App\Domain\Agents\Models\Agent;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreAgentAction
{
    public function execute(StoreAgentDTO $dto)
    {
        DB::beginTransaction();
        try {
            $agent = new Agent();
            $agent->full_name = $dto->getFullName();
            $agent->phone = $dto->getPhone();
            $agent->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $agent;
    }
}
