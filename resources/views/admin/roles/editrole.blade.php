@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Bewerk: {{$role->role}}</strong></div>
                    <div class="card-body">
                        <form method="post" action="/admin/roles/wijzigen/{{$role->id}}">
                            @csrf 
                            <input type="text" name="newrolename"class="form-control" placeholder="{{$role->role}}">
                            <br>
                            <input type="submit" value="Rolnaam wijzigen" class="btn btn-info">

                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
