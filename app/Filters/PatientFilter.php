<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class PatientFilter extends AbstractFilter
{
    public const FULL_NAME = 'full_name';

    public const PHONE = 'phone';

    public const CODE = 'code';

    public const STATUS = 'status';

    /**
     * @return array[]
     */
    #[ArrayShape([self::FULL_NAME => "array", self::STATUS => "array", self::PHONE => "array", self::CODE => "array"])] protected function getCallbacks(): array
    {
        return [
            self::FULL_NAME => [$this, 'full_name'],
            self::PHONE => [$this, 'phone'],
            self::CODE => [$this, 'code'],
            self::STATUS => [$this, 'status'],
        ];
    }

    public function full_name(Builder $builder, $value): void
    {
        $builder->where('full_name', 'like', '%' . $value . '%');
    }

    public function phone(Builder $builder, $value): void
    {
        $builder->where('phone', 'like', '%' . $value . '%');
    }

    public function code(Builder $builder, $value): void
    {
        $builder->where('code', 'Like', '%' . $value . '%');
    }

    public function status(Builder $builder, $value): void
    {
        $builder->where('status', $value);
    }
}
