<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class MKBFilter extends AbstractFilter
{
    public const NAME = 'name';

    public const CODE = 'code';


    /**
     * @return array[]
     */
    #[ArrayShape([self::NAME => "array", self::CODE => "array"])] protected function getCallbacks(): array
    {
        return [
            self::NAME => [$this, 'name'],
            self::CODE => [$this, 'code'],
        ];
    }

    public function name(Builder $builder, $value): void
    {
        $builder->where('name', 'like', '%' . $value . '%');
    }

    public function code(Builder $builder, $value): void
    {
        $builder->where('code', 'like', '%' . $value . '%');
    }
}
