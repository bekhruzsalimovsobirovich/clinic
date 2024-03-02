<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $patient_id
 * @property int $epidemiologic_id
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic query()
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic whereEpidemiologicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic wherePatientId($value)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PatientEpidemiologic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PatientEpidemiologic extends Model
{
    use HasFactory;
}
