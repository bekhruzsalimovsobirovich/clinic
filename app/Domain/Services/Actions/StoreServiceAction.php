<?php

namespace App\Domain\Services\Actions;

use App\Domain\Services\DTO\StoreServiceDTO;
use App\Domain\Services\Models\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreServiceAction
{
    /**
     * @param StoreServiceDTO $dto
     * @return Service
     * @throws Exception
     */
    public function execute(StoreServiceDTO $dto): Service
    {
        DB::beginTransaction();
        try {
            $service = new Service();
            $service->title = $dto->getTitle();
            $service->price = $dto->getPrice();
            $service->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $service;
    }
}
