<?php

namespace App\Domain\Illnesses\Repositories;

use App\Domain\Illnesses\Models\Illness;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IllnessRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return Illness::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Illness::query()
            ->orderByDesc('id')
            ->get();
    }
}
