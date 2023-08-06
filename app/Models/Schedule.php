<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'status_room', 'dokter_id', 'nurse_id', 'patient_sex'];

    function room()
    {
        return $this->belongsTo(Room::class);
    }

    function dokter()
    {
        return $this->belongsTo(Employee::class, 'dokter_id');
    }

    function nurse()
    {
        return $this->belongsTo(Employee::class, 'nurse_id');
    }

    function spesialist()
    {
        return $this->belongsToMany(
            Spesialist::class,
            'spesialist_schedule',
            'schedule_id',
            'spesialist_id'
        );
    }
}
