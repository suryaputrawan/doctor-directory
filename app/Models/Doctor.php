<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'specialist_id', 'sub_specialist_id', 'keterangan', 'notes',
        'site_id', 'picture', 'isAktif'
    ];

    public function getTakeImageAttribute()
    {
        if ($this->picture) {
            return "/storage/" . $this->picture;
        }

        return null;
    }

    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class);
    }

    public function subSpecialist(): BelongsTo
    {
        return $this->belongsTo(SubSpecialist::class);
    }

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }
}
