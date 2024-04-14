<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class PatientAdmissionStatusFilter extends AbstractFilter
{
    public const STATUS_ADMISSION = 'status_admission';

    /**
     * @return array[]
     */
    #[ArrayShape([self::STATUS_ADMISSION => "array"])] protected function getCallbacks(): array
    {
        return [
            self::STATUS_ADMISSION => [$this, 'status_admission'],
        ];
    }

    public function status_admission(Builder $builder, $value): void
    {
        $builder->whereHas('admissions', function ($query) use ($value) {
            $query->whereRaw('JSON_CONTAINS(status->"$[*].type", "' . $value . '")');
        });
    }
}
