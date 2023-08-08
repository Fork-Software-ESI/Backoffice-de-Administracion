<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ChoferController extends Controller
{
    public function mostrarChoferes()
    {
        $chofer = User::where('rol', 'chofer')->get();
        return view('chofer.mostrarChoferes', ['chofer' => $chofer]);
    }
}
