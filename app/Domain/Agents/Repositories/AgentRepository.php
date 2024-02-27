<?php

namespace App\Domain\Agents\Repositories;

use App\Domain\Agents\Models\Agent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AgentRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return Agent::query()
            ->orderBy('id','desc')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Agent::query()
            ->orderBy('id','desc')
            ->get();
    }
}
