@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">You are logged in as {{ Auth::user()->name }}  </h1>
                        <p>Your user ID is {{ Auth::user()->id }}</p>
                        @if(Auth::user()->id == 12)
                            <p>You're an admin!</p>
                            @forelse($users as $user)
                                <ul>
                                    <li>{{ $user->name }}</li>
                            <a href="/users/{{$user->id}}">-Edit User-</a>
                                </ul>
                            @empty
                                <p class="text-warning">No users available</p>
                            @endforelse
                        @else
                            <p>You're not an admin!</p>
                        @endif
                    </div>         
                </div>       
            </div>
        </div>
    </div>
@endsection