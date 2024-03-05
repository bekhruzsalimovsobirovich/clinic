<?php

namespace App\Domain\Payments\Repositories;

use App\Domain\Payments\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator
    {
        return Payment::query()
            ->orderByDesc('id')
            ->paginate();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Payment::query()
            ->orderByDesc('id')
            ->get();
    }

    /**
     * @return Builder[]|Collection
     */
    public function getUserIDForPayment($user_id): Collection|array
    {
        return Payment::query()
            ->where('user_id','=',$user_id)
            ->orderByDesc('id')
            ->get();
    }
}
