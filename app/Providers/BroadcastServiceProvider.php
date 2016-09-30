<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Auth;

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
       // $user = Authenticated User
        //$userId = App.User.* = App.User.$userId  // ekane * er value e hole $userId AND * value ase Broadcast event e channel er naam thake
        Broadcast::channel('App.User.*', function ($user, $userId) {
           return (int) $user->id === (int) $userId;
        });
              
        /*Broadcast::channel('mychannel_one', function ($user) {
            if (true) { // Replace with real authorization
                return [
                    'id' => $user->id,
                    'name' => $user->name
                ];
            }
        });*/

    }
}
