<?php

namespace App\Domain\Epidemiologics\Repositories;

use App\Domain\Epidemiologics\Models\Epidemiologic;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EpidemiologicRepository
{
    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function getPaginate($filter): LengthAwarePaginator
    {
        return Epidemiologic::query()
            ->Filter($filter)
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Epidemiologic::query()
            ->orderByDesc('id')
            ->get();
    }
}
