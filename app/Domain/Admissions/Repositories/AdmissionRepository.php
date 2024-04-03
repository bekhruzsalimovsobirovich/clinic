<?php

namespace App\Domain\Admissions\Repositories;

use App\Domain\Admissions\Models\Admission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdmissionRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Admission::query()
            ->orderByDesc('id')
            ->paginate();
    }


//    navbat
    public function navbat()
    {
        return Admission::query()
            ->where('status',1)
            ->orderByDesc('id')
            ->paginate();
    }

    //  qayta  navbat
    public function qaytaNavbat()
    {
        return Admission::query()
            ->where('status',2)
            ->orderByDesc('id')
            ->paginate();
    }
}
