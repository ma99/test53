@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                  @if  {{ count($user->unreadNotifications) > 0 }}
                     @foreach ($user->unreadNotifications as $notification) 
                        <li> {{ $notification->type }} </li>
                        <li> {{ $notification->data['name'] }} </li>
                        <hr>
                     @endforeach
                  @else
                        <strong>No Notifications</strong>
                  @endif  
                </div>

                <div>
                    <form action="{{ url('notifications') }}" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}

                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i> Mark As Read
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
