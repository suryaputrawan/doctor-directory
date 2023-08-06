<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesialistSchedule extends Model
{
    use HasFactory;

    protected $table = 'spesialist_schedule';

    protected $fillable = ['spesialist_id', 'schedule_id'];
}
