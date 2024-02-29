<?php

namespace App\Domain\Roles\Actions;

use App\Domain\Roles\DTO\StoreRoleDTO;
use App\Domain\Roles\DTO\UpdateRoleDTO;
use App\Domain\Roles\Models\Role;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateRoleAction
{
    /**
     * @param UpdateRoleDTO $dto
     * @return Role
     * @throws Exception
     */
    public function execute(UpdateRoleDTO $dto): Role
    {
        DB::beginTransaction();
        try {
            $role = $dto->getRole();
            $role->title = $dto->getTitle();
            $role->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $role;
    }
}
