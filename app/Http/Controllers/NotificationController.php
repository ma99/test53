<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\Notifications\NewEvent;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function sendnotification()
    {
    	$user = User::find(2);
    	$event = Event::find(3);
    	$user->notify(new NewEvent($event));
    	return 'Notification sent!';
    }

    public function markasread()
    {
    	$user = User::find(1);

		foreach ($user->unreadNotifications as $notification) {
		    $notification->markAsRead();
		}
		return back();
    }
}
