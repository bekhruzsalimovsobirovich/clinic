<?php

namespace App\Domain\Summaries\Repositories;

use App\Domain\Summaries\Models\Summary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class SummaryRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginte(): LengthAwarePaginator
    {
        return Summary::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Summary::query()
            ->orderByDesc('id')
            ->get();
    }
}
