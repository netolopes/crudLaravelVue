<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RefrigeranteController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('refrigerantes');
    }
}
