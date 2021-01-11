@extends('layouts.app', ['title' => 'Mijn gegevens'])

@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">Mijn account bewerken</h5>
                <div class="card-body">
                    <form action="{{ route('pUpdate') }}" method="POST">
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
                        <div class="col text-center">
                            <br>
                            <button type="submit" class="btn btn-primary">Updaten</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
