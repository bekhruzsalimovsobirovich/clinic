<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class UserFilter extends AbstractFilter
{
    public const NAME = 'name';

    public const PHONE = 'phone';

    public const ROLE = 'role';


    /**
     * @return array[]
     */
    #[ArrayShape([self::NAME => "array", self::PHONE => "array", self::ROLE => "array"])] protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::PHONE => [$this, 'phone'],
            self::ROLE => [$this, 'role'],
        ];
    }

    public function name(Builder $builder, $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

    public function phone(Builder $builder, $value): void
    {
        $builder->where('phone', 'like', '%' . $value . '%');
    }

    public function role(Builder $builder, $value): void
    {
        $builder->whereHas('role',function ($query) use ($value) {
            $query->where('title', 'Like', '%' . $value . '%');
        });
    }
}
