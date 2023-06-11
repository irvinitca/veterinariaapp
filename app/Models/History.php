<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;


class History extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointment_id',
        'date_resolved',
        'diagnostic',
        'services',
        'indications',
        'medicaments'
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
