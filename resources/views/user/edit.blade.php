@extends('layouts.app')

@section('content')

@if($user->id == Auth::user()->id || Auth::user()->id == 12)
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/user" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-4">Edit User: {{ $user->name }} </h1>
                    <p>Edit and submit this form to update user info</p>

                    <hr>
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="control-group col-12">
                                <label for="name">User Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                       placeholder="Enter Username" value="{{ $user->name }}" required>
                            </div>

                            <div class="control-group col-12 mt-2">
                                <label for="email">User Email</label>
                                <textarea id="email" class="form-control" name="email" placeholder="Enter Email"
                                          rows="5" required>{{ $user->email }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Update User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <form id="delete-frm" class="" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger">Delete User</button>
                </form>

            </div>
        </div>
    </div>
@else
    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
            <p> You're not authorised to edit this user! </p>
            </div>
        </div>
    </div>
@endif


@endsection