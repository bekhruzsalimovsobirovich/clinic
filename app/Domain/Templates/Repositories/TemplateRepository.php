<?php

namespace App\Domain\Templates\Repositories;

use App\Domain\Templates\Models\Template;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TemplateRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Template::query()
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    public function showUserTemplate($user_id): Collection|array
    {
        return Template::query()
            ->where('user_id','=',$user_id)
            ->orderByDesc('id')
            ->get();
    }
}
