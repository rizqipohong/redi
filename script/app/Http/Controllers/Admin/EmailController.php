<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\Contactmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        $data['content'] = $request->message;
        $data['subject'] = $request->subject;
        $data['to_subscriber'] = $request->email;
        $data['mail_from'] = env('MAIL_TO');
        if (env('QUEUE_MAIL') == 'on') {
            dispatch(new \App\Jobs\SendInvoiceEmail($data));
        } else {
            Mail::to($request->email)->send(new Contactmail($data));
        }

//        change status domain & account seller
        $checkUser=   User::where('email', $request->email)->first();
        User::where('email', $request->email)->update([
            'status' => 1
        ]);
        Domain::where('user_id', $checkUser->id)->update([
            'status' => 1
        ]);
        return response()->json(['Mail Sent Successfully']);
    }


}
