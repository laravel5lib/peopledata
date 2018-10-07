<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\Messages\NewMessageMail;

class MessagesController extends Controller
{
    public function store()
    {
        $this->validate(request(), [
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'emails'  => 'array|min:1',
        ]);
        $emails = request()->get('emails');
        $members = Member::whereIn('email',$emails)->get();
        Mail::to($members)->send(new NewMessageMail(auth()->user(), request()->get('subject'), request()->get('message')));
        $results            = [];
        $results['message'] = 'Mensaje enviado!';

        return $results;
    }
}
