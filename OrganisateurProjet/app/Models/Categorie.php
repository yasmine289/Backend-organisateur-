<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
   protected $fillable = ['nom'];

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }
}
