<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSpecialist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_specialists';

    protected $fillable = ['name'];
}
