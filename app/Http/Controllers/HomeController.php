<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // If User is Karyawan
        if (Auth::user()->role == "2") {
            return  redirect("/logout");
        }
        // If User is User Biasa / Pengirim Ticket
        if (Auth::user()->role == "3") {
            return redirect("/user/home");
        }


        return view('home.index');
    }

    public function homeUser()
    {
        return view('home.index');
    }
}
