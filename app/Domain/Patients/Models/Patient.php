<?php

namespace App\Domain\Patients\Models;

use App\Domain\Agents\Models\Agent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $with = ['agent'];

    protected $casts = [
        'province_city' => 'json'
    ];

//    /**
//     * Get the user's first name.
//     *
//     * @return Attribute
//     */
//    protected function province_city(): Attribute
//    {
//        return Attribute::make(
//            get: fn ($value) => json_decode($value, true),
//            set: fn ($value) => json_encode($value),
//        );
//    }

    protected $perPage = 20;

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
