@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                 <div class="row">
                    <div class="col-8">
                        <h1 class="display-one">You are logged in as {{ Auth::user()->name }}  </h1>
                        <p>Your email adress is {{ Auth::user()->email }} </p>
                        <p>Your user ID is {{ Auth::user()->id }}</p>
                    </div>
                @forelse($users as $user)
                    <ul>
                        <li>{{ $user }}</li>
                    </ul>
                @empty
                    <p class="text-warning">No users available</p>
                @endforelse
                </div>                
            </div>
        </div>
    </div>
@endsection