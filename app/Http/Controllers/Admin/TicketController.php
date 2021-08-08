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

            case 'progress':
                $status_code = 2;
                break;

            case 'complete':
                $status_code = 1;
                break;

            default:
                # code...
                break;
        }
        $tickets = TicketModel::where('status', '=', $status_code)->get();
        $ticket_status = "Pending";
        return view('ticket.admin.manage')->with(compact('ticket_status', 'tickets'));
    }

    
    public function destroy(Request $request){
        $object = TicketModel::find($request->id);
        if ($object->delete()) {
            return redirect('/admin/ticket/pending')->with(["success" => "Berhasil Menghapus Ticket"]);
        } else {
            return redirect('/admin/ticket/pending')->with(["error" => "Gagal Menghapus Ticket"]);
        }

    }
    
    public function update_status(Request $request){
        $object = TicketModel::find($request->id);
        $object->status=$request->status;

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Mengubah Status Ticket Ticket"]);
        } else {
            return back()->with(["error" => "Gagal Mengubah Status Ticket"]);
        }

    }

    public function viewDetail($id){
        $data = TicketModel::find($id);
        $user = User::find($data->sender_id);
        $discussions= Discussion::where('topic','=',$id)->get();

        return view('ticket.edit')->with(compact('data','user','discussions'));
    }
}
