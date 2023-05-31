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
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

}
