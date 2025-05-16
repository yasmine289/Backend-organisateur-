<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
protected $fillable = [
    'user_id',
    'evenement_id',
    'montant',
    'statut',
    'methode'
];

    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }
    public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}
