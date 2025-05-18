<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
     protected $fillable = [
        'user_id', 'categorie_id', 'emplacement_id', 'titre', 'description', 'date_evenement'
    ];
    public function organisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function emplacement()
    {
        return $this->belongsTo(Emplacement::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function interets()
    {
        return $this->hasMany(Interet::class);
    }
    public function clients()
{
    return $this->hasManyThrough(
        \App\Models\User::class,
        \App\Models\Paiement::class,
        'evenement_id',
        'id',
        'id',
        'user_id'
    );
}

protected $dates = [
    'date_evenement',
    'created_at',
    'updated_at'
];
}
