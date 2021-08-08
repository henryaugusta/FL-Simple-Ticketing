<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $sendedMessage="";
        if ($request->message=="" || $request->message==null) {
            // DO NOTHING
        }else{
            $sendedMessage=$request->message;
        }

        $object = new Discussion();

        $object->id_sender = Auth::user()->id;
        $object->message = $sendedMessage;
        $object->topic = $request->topic;

        if ($object->save()) {
            return back()->with(["success" => "Berhasil Menambahkan Diskusi"]);
        } else {
            return back()->with(["error" => "Gagal Menambahkan Diskusi"]);
        }
    }
}
