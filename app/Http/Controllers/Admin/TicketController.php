<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\TicketModel;
use App\Models\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function viewManage($status)
    {
        $status_code = 0;
        switch ($status) {
            case 'pending':
                $status_code = 3;
                break;

            case 'progess':
                $status_code = 2;
                break;

            case 'complete':
                $status_code = 1;
                break;

            default:
                # code...
                break;
        }
        $tickets = TicketModel::where('status', '=', $status_code)
            ->where('status', '=', 3)->get();
        $ticket_status = "Pending";
        return view('ticket.admin.manage')->with(compact('ticket_status', 'tickets'));
    }

    public function viewDetail($id){
        $data = TicketModel::find($id);
        $user = User::find($data->sender_id);
        $discussions= Discussion::where('topic','=',$id)->get();

        return view('ticket.edit')->with(compact('data','user','discussions'));
    }
}
