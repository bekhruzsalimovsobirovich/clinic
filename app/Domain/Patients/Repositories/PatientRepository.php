<?php

namespace App\Domain\Patients\Repositories;

use App\Domain\Patients\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository
{
    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function getPaginate($filter): LengthAwarePaginator
    {
        return Patient::query()
            ->Filter($filter)
            ->orderBy('id','desc')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Patient::query()
            ->orderBy('id','desc')
            ->get();
    }
}
