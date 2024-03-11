<?php

namespace App\Domain\Registries\Models;

use App\Domain\Patients\Models\Patient;
use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $patient_id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder|Registry filter(\App\Filters\FilterInterface $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Registry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Registry extends Model
{
    use HasFactory, Filterable;

    protected $perPage = 30;

    protected $casts = [
        'data' => 'json'
    ];

    protected $with = ['patient'];

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
