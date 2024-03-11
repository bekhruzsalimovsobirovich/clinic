<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class ServiceFilter extends AbstractFilter
{
    public const CHECKED = 'checked';

    /**
     * @return array[]
     */
    #[ArrayShape([self::CHECKED => "array"])] protected function getCallbacks(): array
    {
        return [
            self::CHECKED => [$this, 'checked'],
        ];
    }

    /**
     * @param Builder $builder
     * @param $value
     * @return void
     */
    public function checked(Builder $builder, $value): void
    {
        $builder->where('checked', '=', $value);
    }
}
