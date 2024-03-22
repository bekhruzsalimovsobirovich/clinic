<?php

namespace App\Domain\Payments\Models;

use App\Domain\Patients\Models\Patient;
use App\Domain\Services\Models\Service;
use App\Domain\UserPatients\Models\UserPatient;
use App\Models\Traits\Filterable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $patient_id
 * @property int|null $service_id
 * @property float|null $service_price
 * @property float|null $difference_price
 * @property float|null $pay_patient
 * @property float|null $return_patient_pay
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Patient $patient
 * @property-read Service|null $service
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment filter(\App\Filters\FilterInterface $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDifferencePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePayPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReturnPatientPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereServicePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 * @property int $status to'langan bo'lsa 1, to'lanmagan bo'lsa 0
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereStatus($value)
 * @property int $return_status qayta navbat holati 1, 0 bo'lsa birinchi marta kelgan
 * @property array|null $pays to'lovlar
 * @property-read UserPatient $user_patients
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReturnStatus($value)
 * @mixin \Eloquent
 */
class Payment extends Model
{
    use HasFactory, Filterable;

    protected $perPage = 30;

    protected $with = ['service', 'patient','user_patients'];

    protected $casts = [
        'pays' => 'json'
    ];



//    public function services()
//    {
//        return $this->belongsTo(Service::class,'pays_title');
//    }

    public function user_patients()
    {
        return $this->belongsTo(UserPatient::class,'patient_id','patient_id');
    }

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * @return BelongsTo
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
