<?php

namespace App\Domain\Patients\Repositories;

use App\Domain\Patients\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PatientRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return Patient::query()
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
