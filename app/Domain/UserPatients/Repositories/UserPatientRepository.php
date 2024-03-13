<?php

namespace App\Domain\UserPatients\Repositories;

use App\Domain\UserPatients\Models\UserPatient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserPatientRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return UserPatient::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return UserPatient::query()
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $user_id
     * @return Builder[]|Collection
     */
    public function getUserIDForPatient($user_id): Collection|array
    {
        return UserPatient::query()
            ->where('user_id','=',$user_id)
            ->orderByDesc('id')
            ->get();
    }
}
