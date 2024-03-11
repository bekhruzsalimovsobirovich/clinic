<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class PaymentFilter extends AbstractFilter
{
    public const FULL_NAME = 'full_name';

    public const BIRTHDAY = 'birthday';

    public const CODE = 'code';

    public const RETURN_STATUS = 'return_status';


    /**
     * @return array[]
     */
    #[ArrayShape([self::FULL_NAME => "array", self::BIRTHDAY => "array", self::CODE => "array", self::RETURN_STATUS => "array"])] protected function getCallbacks(): array
    {
        return [
            self::FULL_NAME => [$this, 'full_name'],
            self::BIRTHDAY => [$this, 'birthday'],
            self::CODE => [$this, 'code'],
            self::RETURN_STATUS => [$this, 'return_status'],
        ];
    }

    public function full_name(Builder $builder, $value): void
    {
        $builder->whereHas('patient',function ($query) use ($value) {
            $query->where('full_name', 'Like', '%' . $value . '%');
        });
    }

    public function birthday(Builder $builder, $value): void
    {
        $builder->whereHas('patient',function ($query) use ($value) {
            $query->where('birthday', 'Like', '%' . $value . '%');
        });
    }

    public function code(Builder $builder, $value): void
    {
        $builder->whereHas('patient',function ($query) use ($value) {
            $query->where('code', 'Like', '%' . $value . '%');
        });
    }

    public function return_status(Builder $builder, $value): void
    {
        $builder->where('return_status', '=', $value);
    }
}
