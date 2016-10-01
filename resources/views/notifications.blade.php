@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User's List</h2> 
        <ul id="user-list"> 
        </ul> 
</div>
@endsection
@section('scripts')
    <script> 
            // Briding with broadcaster
            // import Echo from "laravel-echo"
            // window.Echo = new Echo({
            //     broadcaster: 'pusher',
            //     key: '98b9f6229a65f62bb1da'
            // });

            // Subscribing & listening
           /* Echo.private('mychannel_one')
            .listen('UserRegisteredEvent', function(e) {
                console.log(e.user);
            });*/
            //var userId = 1;
           // Echo.private('App.User.' + userId)
            Echo.private('App.User.1')
                .notification((notification) => {
                    console.log(notification.type);
                    console.log(notification.name);
                    console.log(notification.email);
            });
            
        </script> 
@endsection          