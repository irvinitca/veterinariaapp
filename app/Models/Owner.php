<?php

namespace App\Models;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'dui',
        'phone',
    ];

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }


}
