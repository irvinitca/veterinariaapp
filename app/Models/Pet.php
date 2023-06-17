<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owner;


class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'name',
        'weight',
        'breed',
        'type',
        'age',
        'estado',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function petType()
    {
        return $this->belongsTo(Type::class, 'type');
    }

    public function petBreed()
    {
        return $this->belongsTo(Breed::class, 'breed');
    }

}
