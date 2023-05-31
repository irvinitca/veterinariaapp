<?php

namespace App\Models;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;



    public function pets()
{
    return $this->hasMany(Pet::class);
}

}
