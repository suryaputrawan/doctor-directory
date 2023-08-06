<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialist extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    function schedule()
    {
        return $this->belongsToMany(
            Schedule::class,
            'spesialist_schedule',
            'spesialist_id',
            'schedule_id'
        );
    }
}
