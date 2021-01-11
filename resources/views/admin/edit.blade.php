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
                            <br>
                            <ul class="list-group">
                                <?php
                                    $u = App\Models\UserRole::all()->where('user_id', $user->id);
                                    $ar = array();
                                    foreach($u as $item) {
                                        $ar[] = $item->role_id;

                                    }
                                ?>
                                <li class="list-group-item bg-green text-white">Huidige Rol(len)</li>
                                @foreach($ar as $item)
                                    <li class="list-group-item">{{ App\Models\Roles::all()->where('id', $item)->first()->role }}</li>
                                @endforeach
                            </ul>
                            @foreach($roles as $role)
                                <div style="display: inline-block; padding-top: 20px" class="form-check">
                                    <input class="" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->role }}">
                                    <label for="{{ $role->role }}">{{ $role->role }}</label>
                                </div>
                            @endforeach
                            <div class="d-flex flex-row justify-content-between">
                                <button style="display: block" type="submit" class="btn bg-green text-white">Updaten</button>
                                <form action="{{ route('aDelete', $user) }}" method="POST">
                                    @csrf @method('delete')
                                    <button style="display: block" type="submit" class="btn btn-danger">
                                        Verwijderen
                                    </button>
                                </form>
                                <button style="display: block" href="{{ route('aIndex') }}"class="btn btn-warning">Annuleren</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    </html>
@endsection
