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

    public function paginateTypeAdmissionStatus($filter)
    {
        return Patient::query()
            ->Filter($filter)
            ->with('admissions')
            ->orderByDesc('id')
            ->paginate();
    }

//    qabuli yakunlanganlar ro'yxati

    /**
     * @param $filter
     * @return Collection|array
     */
    public function paginateEndPatient($filter): Collection|array
    {
        return Patient::query()
            ->Filter($filter)
            ->orderBy('id','desc')
            ->get();
    }
}
