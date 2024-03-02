<?php

namespace App\Domain\Illnesses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Illness newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Illness newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Illness query()
 * @method static \Illuminate\Database\Eloquent\Builder|Illness whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Illness whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Illness whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Illness whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Illness whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Illness extends Model
{
    use HasFactory;

    protected $fillable = ['title','code'];

    protected $perPage = 20;
}
