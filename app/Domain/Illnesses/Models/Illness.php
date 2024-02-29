<?php

namespace App\Domain\Illnesses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    use HasFactory;

    protected $fillable = ['title','code'];

    protected $perPage = 20;
}
