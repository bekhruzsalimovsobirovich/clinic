<?php

namespace App\Domain\UserPatients\Models;

use App\Domain\Admissions\Models\Admission;
use App\Domain\Patients\Models\Patient;
use App\Domain\Payments\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $patient_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Patient|null $patient
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Payment> $payment
 * @property-read int|null $payment_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPatient whereUserId($value)
 * @mixin \Eloquent
 */
class UserPatient extends Model
{
    use HasFactory;

    protected $perPage = 30;

    protected $with = ['user','patient','payment'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class)
            ->without(['payments','admissions']);
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class,'patient_id','patient_id')
            ->without(['patient','user_patients']);
    }
}
