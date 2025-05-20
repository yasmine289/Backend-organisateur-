<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use Illuminate\Http\Request;
use App\Models\Event;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:utilisateur']);
    }

    public function dashboard()
    {
        $evenements = Evenement::where('date_evenement', '>', now())
                       ->orderBy('date_evenement', 'asc')
                       ->take(6)
                       ->get();

        return view('utilisateur.dashboard', compact('evenements'));
    }


    public function showEvent(Evenement $event)
    {
        return view('user.events.show', compact('event'));
    }
}
