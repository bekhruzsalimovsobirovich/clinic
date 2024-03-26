<?php

namespace App\Domain\Readmissions\Repositories;

use App\Domain\Readmissions\Models\Readmission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ReadmissionRepository
{
//    ----------------------------------------------------- QAYTA NAVBAT -----------------------------------------------
    /**
     * @return LengthAwarePaginator
     */
    public function paginateQaytaNavbat(): LengthAwarePaginator
    {
        return Readmission::query()
            ->where('status',1)
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllQaytaNavbat(): Collection|array
    {
        return Readmission::query()
            ->where('status',1)
            ->orderByDesc('id')
            ->get();
    }
//    ----------------------------------------------------- QAYTA NAVBAT -----------------------------------------------
//    ----------------------------------------------------- DISPONSER RO'YXATI -----------------------------------------

    /**
     * @return LengthAwarePaginator
     */
    public function paginateDisponser(): LengthAwarePaginator
    {
        return Readmission::query()
            ->where('status',2)
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllDisponser(): Collection|array
    {
        return Readmission::query()
            ->where('status',2)
            ->orderByDesc('id')
            ->get();
    }


//    ----------------------------------------------------- DISPONSER RO'YXATI -----------------------------------------
}
