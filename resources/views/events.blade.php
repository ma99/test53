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
            Echo.join('mychannel_one')
                .here(function (members) {
                    // runs when you join
                    console.table(members);
                })
                .joining(function (joiningMember, members) {
                    // runs when another member joins
                    console.log('Member Joined:');
                    console.table(joiningMember);
                })
                .leaving(function (leavingMember, members) {
                    // runs when another member leaves
                    console.log('Member Left:');
                    console.table(leavingMember);
                });
            
            
        </script> 
@endsection          