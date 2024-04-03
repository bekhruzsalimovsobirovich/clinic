<?php

namespace App\Domain\Admissions\Models;

use App\Domain\Files\Models\File;
use App\Domain\Patients\Models\Patient;
use App\Domain\UserPatients\Models\UserPatient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Admission extends Model
{
    use HasFactory;

    protected $perPage = 30;

    protected $casts = [
        'admissions' => 'json'
    ];

    protected $with = ['patient'];

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class)->without('admissions');
    }

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
