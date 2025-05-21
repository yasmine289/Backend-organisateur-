<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with(['user', 'evenement'])
            ->latest()
            ->paginate(10);

        return view('organisateur.paiements.index', compact('paiements'));
    }
}