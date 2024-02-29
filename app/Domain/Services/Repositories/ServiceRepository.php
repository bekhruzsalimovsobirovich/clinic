<?php

namespace App\Domain\Services\Repositories;

use App\Domain\Services\Models\Service;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ServiceRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return Service::query()
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Service::query()
            ->orderBy('id', 'desc')
            ->get();
    }
}
