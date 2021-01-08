@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <form method="post" action="/roles/edit/{{$role->id}}">
                            @csrf 
                            <input type="text" name="newrolename" class="form-control" placeholder="{{$role->role}}">
                            <br>
                            <input type="submit" class="btn btn-info">

                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection
