@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Voeg een nieuwe rol toe.</strong></div>
                    <div class="card-body">
                        <form method="post" action="/admin/roles/add">
                            @csrf
                            <input type="text" class="form-control" name="addRole" placeholder="Nieuwe rol...">
                            <br>
                            <input type="submit" class="btn btn-primary form-control" name="add" value="Toevoegen">
                        </form>
                        
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
