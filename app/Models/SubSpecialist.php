<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSpecialist extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sub_specialists';

    protected $fillable = ['name'];

    public function doctor(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
