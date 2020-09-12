<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function create()
    {
        return view('emails.mail_form');
    }

    public function send(Request $request)
    {
        if ($request->isMethod('post')) {

            $input = $request->except('_token');

            try {

                    Mail::send('emails.mail_blank', ['data' => $input], function($message) use($input){

                        $message->from($input['email'], $input['name']);
                        $message->to($input['email'])->subject('Question');
                    });

                } catch (\Exception $exception) {

                return back()->withErrors($exception->getMessage())->withInput();
            }

            return redirect('/home')->with('status', 'The mail was sent');
        }

        return view('emails.mail_form');
    }
}
