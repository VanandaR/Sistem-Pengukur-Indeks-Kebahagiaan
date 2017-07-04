<?php

namespace App\Http\Controllers;

use App\Happiness;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $happiness=Happiness::all();
        return view('landingpage',['happiness'=>$happiness]);
    }
}
