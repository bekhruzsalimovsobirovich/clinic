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
     * @return array|Collection
     */
    public function searchPatient($filter): array|Collection
    {
        return Patient::query()
            ->Filter($filter)
            ->orderBy('id','desc')
            ->get();
    }
    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function getPaginate($filter): LengthAwarePaginator
    {
        return Patient::query()
            ->with('admissions')
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

    public function paginateNavbat()
    {
        return Patient::query()
            ->with('admissions')
            ->whereHas('admissions', function ($query){
                $query->where('status',1);
            })
            ->orderByDesc('id')
            ->paginate();
    }

    public function paginateQaytaNavbat()
    {
        return Patient::query()
            ->with('admissions')
            ->whereHas('admissions', function ($query){
                $query->where('status',2);
            })
            ->orderByDesc('id')
            ->paginate();
    }


//    qabuli yakunlanganlar ro'yxati

    /**
     * @return Collection|array
     */
    public function paginateEndPatient(): Collection|array
    {
        return Patient::query()
            ->where('status','=',1)
            ->orderBy('id','desc')
            ->get();
    }
}
