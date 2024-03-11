<?php

namespace App\Domain\Services\Actions;

use App\Domain\Services\DTO\StoreServiceDTO;
use App\Domain\Services\DTO\UpdateServiceDTO;
use App\Domain\Services\Models\Service;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateServiceAction
{
    /**
     * @param UpdateServiceDTO $dto
     * @return Service
     * @throws Exception
     */
    public function execute(UpdateServiceDTO $dto): Service
    {
        DB::beginTransaction();
        try {
            $service = $dto->getService();
            $service->title = $dto->getTitle();
            $service->price = $dto->getPrice();
            $service->checked = $dto->getChecked();
            $service->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $service;
    }
}
