<?php

namespace App\Domain\Roles\Actions;

use App\Domain\Roles\DTO\StoreRoleDTO;
use App\Domain\Roles\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreRoleAction
{
    /**
     * @param StoreRoleDTO $dto
     * @return Role
     * @throws Exception
     */
    public function execute(StoreRoleDTO $dto): Role
    {
        DB::beginTransaction();
        try {
            $role = new Role();
            $role->title = $dto->getTitle();
            $role->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $role;
    }
}
