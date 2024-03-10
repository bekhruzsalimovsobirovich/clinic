<?php

namespace App\Domain\Registries\Repositories;

use App\Domain\Registries\Models\Registry;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RegistryRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Registry::query()
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
