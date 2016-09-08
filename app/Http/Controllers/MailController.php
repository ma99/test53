<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mail\Reminder;
use App\Event;



class MailController extends Controller
{
    public function sendmail(Request $request, Event $event)
    {
    	//$event = Event::first();
    	//$event = Event::findOrFail($eventId);
    	//Mail::to($request->user())->send(new Reminder($event));
    	Mail::to('ma99.dev@gmail.com')->send(new Reminder($event));
    	return 'mail sent!';
    }
}
