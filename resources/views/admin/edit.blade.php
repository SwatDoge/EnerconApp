@extends('layouts.app')

@section('content')
    <html>
        <body>
            <div class="container p-5">
                <div class="card">
                    <div class="card-header">Bewerk <b>{{$user->name}}</b>, ID: <b>{{$user->id}}</b></div>
                    <div class="card-body">
                        <form action="{{ route('aUpdate') }}" method="post">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            @csrf @method('patch')
                            <div class="list-group">
                                <label for="name">Naam:</label>
                                <input type="text" name="name" value="{{ $user->name }}" id="name" class="form-control" placeholder="{{ $user->name }}">
                            </div>
                            <div class="list-group">
                                <label for="email">E-mail:</label>
                                <input type="text" name="email" value="{{ $user->email }}" id="email" class="form-control" placeholder="{{ $user->email }}">
                            </div>
                            @foreach($roles as $role)
                                <div style="display: inline-block; padding-top: 20px" class="form-check">
                                    <input class="" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->name }}" >
                                    <label for="{{ $role->name }}">{{ $role->name }}</label>
                                </div>
                            @endforeach
                            <button style="display: block" type="submit" class="btn btn-primary">Updaten</button>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
@endsection