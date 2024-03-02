<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use JetBrains\PhpStorm\ArrayShape;

class EpidemiologicFilter extends AbstractFilter
{
    public const TITLE = 'title';

    /**
     * @return array[]
     */
    #[ArrayShape([self::TITLE => "array"])] protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
        ];
    }

    public function title(Builder $builder, $value): void
    {
        $builder->where('title', 'like', '%' . $value . '%');
    }
}
