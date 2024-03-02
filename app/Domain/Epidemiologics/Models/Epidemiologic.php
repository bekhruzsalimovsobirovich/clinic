<?php

namespace App\Domain\Epidemiologics\Models;

use App\Domain\Patients\Models\Patient;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Patient> $patients
 * @property-read int|null $patients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Epidemiologic filter(\App\Filters\FilterInterface $filter)
 * @mixin \Eloquent
 */
class Epidemiologic extends Model
{
    use HasFactory, Filterable;

    protected $perPage = 20;

    public function patients()
    {
        return $this->belongsToMany(Patient::class,'patient_epidemiologics');
    }
}
