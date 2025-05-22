<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'evenement_id',
        'user_id',
        'nom',
        'email',
        'nombre_tickets',
        'montant_total',
        'statut',
        'reference',
        'reference_paiement',
        'date_paiement'
    ];

    /**
     * Relation avec l'événement
     */
    public function evenement()
    {
        return $this->belongsTo(Evenement::class);
    }

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
