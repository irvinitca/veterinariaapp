<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pet_id',
        'rate_id',
        'date_start',
        'date_end',
        'reason',
        'type',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
}
