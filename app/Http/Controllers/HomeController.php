<?php

namespace App\Http\Controllers;

use App\Models\TicketModel;
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
            return redirect("/operator/home");
        }
        // If User is User Biasa / Pengirim Ticket
        if (Auth::user()->role == "3") {
            return redirect("/user/home");
        }
        // If User is User Admin
        if (Auth::user()->role == "1") {
            return redirect("/admin/home");
        }


        return view('home.index');
    }

    public function homeUser()
    {
        $auth = Auth::user()->id;
        $totalTicket = TicketModel::all()->where('sender_id','=',$auth)->count();
        $totalTicketPending =TicketModel::where('sender_id','=',$auth)->where('status','=','3')->count(); 
        $totalTicketSolved = TicketModel::where('sender_id','=',$auth)->where('status','=','1')->count();
        $totalTicketProgress = TicketModel::where('sender_id','=',$auth)->where('status','=','2')->count();

        $tickets = TicketModel::all();
        return view('home.user')
            ->with(compact('totalTicket', 'totalTicketPending', 'totalTicketSolved', 'totalTicketProgress', 'tickets'));
    }
    public function homeAdmin()
    {
        $totalTicket = TicketModel::all()->count();
        $totalTicketPending =TicketModel::where('status','=','3')->count(); 
        $totalTicketSolved = TicketModel::where('status','=','1')->count();
        $totalTicketProgress = TicketModel::where('status','=','2')->count();

        $tickets = TicketModel::all();
        return view('home.admin')
            ->with(compact('totalTicket', 'totalTicketPending', 'totalTicketSolved', 'totalTicketProgress', 'tickets'));
    }
}
