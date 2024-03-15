<?php

namespace App\Domain\UserPatients\Models;

use App\Domain\Patients\Models\Patient;
use App\Domain\Payments\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPatient extends Model
{
    use HasFactory;

    protected $perPage = 30;

//    protected $with = ['user','patient','payment'];

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
        return $this->belongsTo(Patient::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class,'patient_id','patient_id');
    }
}
