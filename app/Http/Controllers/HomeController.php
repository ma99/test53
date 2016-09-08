<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$user = User::find(1);
        //$user = auth()->user();  // helper
        $user = Auth::user();   //facade

        return view('home', compact('user'));
    }
}
