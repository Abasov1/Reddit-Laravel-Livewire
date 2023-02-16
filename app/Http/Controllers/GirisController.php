<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GirisController extends Controller
{
    public function index(){
        return view('auth.login');
    }
}
