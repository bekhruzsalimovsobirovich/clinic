<?php

namespace App\Domain\Appointments\Repositories;

use App\Domain\Appointments\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AppointmentRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Appointment::query()
            ->orderByDesc('id')
            ->get();
    }
}
