<?php

namespace App\Domain\Registries\Models;

use App\Domain\Patients\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registry extends Model
{
    use HasFactory;

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
