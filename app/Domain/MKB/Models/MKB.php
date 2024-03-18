<?php

namespace App\Domain\MKB\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name Наименование
 * @property string $code Код
 * @property int|null $parent_id Вышестоящий объект
 * @property string|null $parent_code Код вышестоящего объекта
 * @property int $node_count Количество вложенных в текущую ветку
 * @property string|null $additional_info Дополнительные данные
 * @method static \Illuminate\Database\Eloquent\Builder|MKB filter(\App\Filters\FilterInterface $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MKB newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MKB query()
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereAdditionalInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereNodeCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereParentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MKB whereParentId($value)
 * @mixin \Eloquent
 */
class MKB extends Model
{
    use HasFactory, Filterable;

    protected $table = 'class_mkb';

    protected $perPage = 30;
}
