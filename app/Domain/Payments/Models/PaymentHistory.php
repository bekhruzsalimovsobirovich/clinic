<?php

namespace App\Domain\Payments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereDifferencePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePayPatient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereReturnPatientPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereServicePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereUserId($value)
 * @property int $status to'langan bo'lsa 1, to'lanmagan bo'lsa 0
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereStatus($value)
 * @property int $return_status qayta navbat holati 1, 0 bo'lsa birinchi marta kelgan
 * @property array|null $pays to'lovlar
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory wherePays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentHistory whereReturnStatus($value)
 * @mixin \Eloquent
 */
class PaymentHistory extends Model
{
    use HasFactory;

    protected $fillable = ['pays'];

    protected $casts = [
        'pays' => 'json',
        'services' => 'json'
    ];
}
