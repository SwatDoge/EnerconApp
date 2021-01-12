@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gebruiker aanmaken</div>

                <div class="card-body">
                    <form class="p-4" method="GET" action="{{ route('aStore') }}">
                        @csrf
                        <input type="text" class="form-control" name="name" placeholder="Voor en Achternaam..."><br>
                        <input type="email" class="form-control" name="email" placeholder="E-mail..."><br>
                        <input type="text" class="form-control" name="pnumber" placeholder="06-12345678"><br>
                        <strong>Rol geven</strong>: <br>
                        @foreach($roles as $role)
                            <div style="display: inline-block; padding-top: 20px" class="form-check">
                                <input class="" type="checkbox" name="roles[]" value="{{ $role->id }}" id="{{ $role->role }}">
                                <label for="{{ $role->role }}">{{ $role->role }}</label>
                            </div>
                        @endforeach
                        <input type="submit" class="form-control btn bg-green white" value="Gebruiker aanmaken"><br>

                        * Standaard wachtwoord = Welkom123
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
