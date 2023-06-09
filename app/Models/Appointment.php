<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'user_id',
        'status',
        'date_start',
        'date_end',
        'reason',
        'type',
    ];
    public function getTypeLabel()
    {
        $types = [
            1 => 'Consulta',
            2 => 'Emergencia',
        ];

        return $types[$this->type] ?? 'Desconocido';
    }
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cobrador()
    {
        return $this->belongsTo(User::class);
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class);
    }
    public function history()
    {
        return $this->hasOne(History::class);
    }


}
