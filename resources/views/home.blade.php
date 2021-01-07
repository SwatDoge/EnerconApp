@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    
                    <form method="post" action="/giverole">
                        @csrf
                        <select class="form-control" name="username">
                            @foreach($users as $user)
                            <option value=" {{$user->id}} ">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <select class="form-control" name="rolename">
                            @foreach($roles as $role)
                            <option value=" {{$role->id}} ">{{ $role->role }}</option>
                            @endforeach
                        </select>

                        <input type="submit">   
                    </form>
                    <br>
                    <br>

                    <form method="post" action="/addrole">
                        @csrf
                        <input type="text" name="addRole" placeholder="Nieuwe rolnaam">
                        <input type="submit" name="toevoegen" value="Toevoegen">
                    </form>
                    <br>
                    <br>
                    <br>
                    @foreach($roles as $role)
                      
                            <a href="/roles/{{$role->id}}/edit" class="btn btn-primary">Bewerk {{$role->role}}</a>
                      
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
