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
 * @mixin \Eloquent
 */
class PatientEpidemiologic extends Model
{
    use HasFactory;
}
