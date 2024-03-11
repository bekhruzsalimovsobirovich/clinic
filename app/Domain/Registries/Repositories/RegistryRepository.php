<?php

namespace App\Domain\Registries\Repositories;

use App\Domain\Registries\Models\Registry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RegistryRepository
{
    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function paginate($filter): LengthAwarePaginator
    {
        return Registry::query()
            ->Filter($filter)
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Registry::query()
            ->orderByDesc('id')
            ->get();
    }
}
