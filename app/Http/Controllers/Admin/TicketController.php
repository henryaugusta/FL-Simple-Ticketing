<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\TicketModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            case 'undelegated':
                $status_code = 123;

                break;

            case 'mywork':
                $tickets = TicketModel::where('delegate_id', '=', Auth::user()->id)
                    ->where('status', '!=', 99)->get();
                $ticket_status = "";
                $operators = User::where([
                    ['role', '=', '2'],
                ])->get();

                return view('ticket.admin.manage')->with(compact('ticket_status', 'tickets', 'operators'));
                break;

            default:
                # code...
                break;
        }
        $tickets = TicketModel::where('status', '=', $status_code)->get();
        $ticket_status = "";
        $operators = User::where([
            ['role', '=', '2'],
        ])->get();

        if (Auth::user()->role == 2) {
            $tickets = TicketModel::where('delegate_id', '=', Auth::user()->id)->where('status', '=', $status_code)->get();
        }


        if ($status_code == 123) {
            $tickets = TicketModel::where('delegate_id', '=', null)->where('status', '!=', 99)->get();
        }


        return view('ticket.admin.manage')->with(compact('ticket_status', 'tickets', 'operators'));
    }


    function delegate(Request $request)
    {
        $object = TicketModel::find($request->id);
        $object->delegate_id = $request->delegate_id;
        $user = User::find($request->delegate_id);

        $discussions = new Discussion();
        $discussions->message = "Ticket Ini Telah Dihandover kepada operator $user->name";
        $discussions->type = 3;
        $discussions->topic = $object->id;
        $discussions->save();

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Handover Ticket Kepada $user->name"]);
        } else {
            return back()->with(["error" => "Gagal Handover Ticket Kepada $user->name"]);
        }
    }

    public function destroy(Request $request)
    {
        $object = TicketModel::find($request->id);
        if ($object->delete()) {
            return redirect('/admin/ticket/pending')->with(["success" => "Berhasil Menghapus Ticket"]);
        } else {
            return redirect('/admin/ticket/pending')->with(["error" => "Gagal Menghapus Ticket"]);
        }
    }

    public function update_status(Request $request)
    {
        $object = TicketModel::find($request->id);
        $object->status = $request->status;

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Mengubah Status Ticket Ticket"]);
        } else {
            return back()->with(["error" => "Gagal Mengubah Status Ticket"]);
        }
    }

    public function viewDetail($id)
    {
        $data = TicketModel::find($id);
        $user = User::find($data->sender_id);
        $discussions = Discussion::where('topic', '=', $id)->get();
        $operators = User::where('role', '=', '2')->get();

        return view('ticket.edit')->with(compact('data', 'user', 'discussions', 'operators'));
    }
}
