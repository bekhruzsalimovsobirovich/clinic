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
            ->with(['user','patient','payment'=>function($query){
                $query->without(['user','user_patient','service']);
            }])
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Collection|Builder[]
     */
    public function getAll(): array|Collection
    {
        return UserPatient::query()
            ->with(['user','patient','payment'=>function($query){
                $query->without(['user','user_patient','service']);
            }])
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @param $user_id
     * @return LengthAwarePaginator
     */
    public function getUserIDForPatientNavbat($user_id): LengthAwarePaginator
    {
        return UserPatient::query()
            ->with(['user','patient','admissionNavbat'])
            ->where('user_id','=',$user_id)
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @param $user_id
     * @return LengthAwarePaginator
     */
    public function getUserIDForPatientQaytaNavbat($user_id): LengthAwarePaginator
    {
        return UserPatient::query()
            ->with(['user','patient','admissionQaytaNavbat'])
            ->where('user_id','=',$user_id)
            ->orderByDesc('id')
            ->paginate();
    }

    public function paginateNavbat()
    {
        return UserPatient::query()
            ->with(['user','patient','admissionNavbat'])
            ->orderByDesc('id')
            ->paginate();
    }

    public function paginateQaytaNavbat()
    {
        return UserPatient::query()
            ->with(['user','patient','admissionQaytaNavbat'])
            ->orderByDesc('id')
            ->paginate();
    }
}
