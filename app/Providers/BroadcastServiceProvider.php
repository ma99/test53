<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();

        /*
         * Authenticate the user's personal channel...
         */
        
        // Broadcast::channel('App.User.*', function ($user, $userId) {
        //     return (int) $user->id === (int) $userId;
        // });
        /* working 
        $userId = 1;
        //$channelId =2;
        Broadcast::channel('mychannel_one', function ($user) use ($userId) {
            return (int) $user->id === (int) $userId;
        });
        */
        Broadcast::channel('mychannel_one', function ($user) {
            if (true) { // Replace with real authorization
                return [
                    'id' => $user->id,
                    'name' => $user->name
                ];
            }
        });

    }
}
