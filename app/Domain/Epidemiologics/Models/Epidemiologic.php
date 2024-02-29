<?php

namespace App\Domain\Epidemiologics\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epidemiologic extends Model
{
    use HasFactory;

    protected $perPage = 20;
}
