<?php

namespace App\Domain\Epidemiologics\Models;

use App\Domain\Patients\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epidemiologic extends Model
{
    use HasFactory;

    protected $perPage = 20;

    public function patients()
    {
        return $this->belongsToMany(Patient::class,'patient_epidemiologics');
    }
}
