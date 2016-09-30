<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Http\Requests;
use App\Notifications\NewEvent;
use App\Notifications\NewUserRegisteredNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function sendNotification()
    {
       /* working  
        $user = User::find($userId);
    	//$user = User::find(2);
    	$event = Event::find(3);
    	$user->notify(new NewEvent($event));*/
        $admin = User::find(1);
        $user = User::find(2) ;
        event(new UserRegisteredEvent($user));
        $admin->notify(new NewUserRegisteredNotification($user));

    	return 'Notification sent!';
    }

    public function show()
    {
        return view('notifications');
    }

    public function markasRead()
    {
    	//$user = User::find(1);
    	 //$user = auth()->user();  // helper
    	$user = Auth::user();

		foreach ($user->unreadNotifications as $notification) {
		    $notification->markAsRead();
		}
		return back();
    }
}
