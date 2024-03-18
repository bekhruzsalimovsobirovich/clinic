<?php

namespace App\Domain\MKB\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MKB extends Model
{
    use HasFactory;

    protected $table = 'class_mkb';

    protected $perPage = 30;
}
