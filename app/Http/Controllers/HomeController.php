<?php

namespace App\Http\Controllers;

use Auth;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        } elseif (Auth::user()->hasRole('pengampu')) {
            return redirect('/pengampu');
        } elseif (Auth::user()->hasRole('peserta')) {
            return redirect('/peserta');
        }
    }
}