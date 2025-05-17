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

    return view('utilisateur.dashboard');
}

    public function showEvent(Evenement $event)
    {
        return view('user.events.show', compact('event'));
    }
}
