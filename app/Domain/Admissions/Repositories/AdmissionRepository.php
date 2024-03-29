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
}
