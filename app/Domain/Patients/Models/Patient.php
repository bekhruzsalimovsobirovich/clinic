<?php

namespace App\Domain\Patients\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name','agent_id','workplace','birthday','province_city','address','job','phone','description','avatar'
    ];

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
}
