<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplacement extends Model
{
    protected $fillable = ['nom', 'adresse'];

    public function evenements()
    {
        return $this->hasMany(Evenement::class);
    }
}
