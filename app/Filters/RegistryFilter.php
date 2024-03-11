<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class RegistryFilter extends AbstractFilter
{
    public const FULL_NAME = 'full_name';

    public const PHONE = 'phone';

    public const CODE = 'code';


    /**
     * @return array[]
     */
    #[ArrayShape([self::FULL_NAME => "array", self::PHONE => "array", self::CODE => "array"])] protected function getCallbacks(): array
    {
        return [
            self::FULL_NAME => [$this, 'full_name'],
            self::PHONE => [$this, 'phone'],
            self::CODE => [$this, 'code'],
        ];
    }

    public function full_name(Builder $builder, $value): void
    {
        $builder->whereHas('patient', function ($query) use ($value) {
            $query->where('full_name', 'like', '%' . $value . '%');
        });
    }

    public function phone(Builder $builder, $value): void
    {
        $builder->whereHas('patient', function ($query) use ($value) {
            $query->where('phone', 'like', '%' . $value . '%');
        });
    }

    public function code(Builder $builder, $value): void
    {
        $builder->whereHas('patient', function ($query) use ($value) {
            $query->where('code', 'like', '%' . $value . '%');
        });
    }
}
