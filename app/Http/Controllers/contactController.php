<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactController extends Controller
{

    public function index()
    {

        $n1 = Request()->name;
        $n2 = Request()->add;
        return view('pages.contact',compact('n1','n2'));
    }

    
    
}
