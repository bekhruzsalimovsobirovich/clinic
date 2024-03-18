<?php

namespace App\Domain\Payments\Repositories;

use App\Domain\Payments\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository
{
    /**
     * @param $filter
     * @return LengthAwarePaginator
     */
    public function paginate($filter)
    {
        $payments =Payment::query()
            ->Filter($filter)
            ->orderByDesc('id')
            ->paginate(30);

        return $payments->setCollection($payments->groupBy('patient.full_name'));
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
     * @param $user_id
     * @return LengthAwarePaginator
     */
    public function getUserIDForPayment($user_id): LengthAwarePaginator
    {
        return Payment::query()
            ->whereHas('user_patients',function ($query) use ($user_id) {
                $query->where('user_id',$user_id);
            })
            ->orderByDesc('id')
            ->paginate();
    }
}
