@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <switchletter 
        rollen= "{{App\Models\Roles::all()->whereIn('id', App\Models\UserRole::all()-> where('user_id', auth()->user()->id)->pluck('role_id'))->pluck('role')}}"
        users=  "{{App\Models\User::all()}}"
        route=  "{{Route::currentRouteName()}}"
        editinit= "{{App\Models\SL::all()->where('id', $SL->id)->First()}}"
        stappen= "{{App\Models\Stappen::all()->where('brief_id', $SL->id)}}"
    >
        {{csrf_field()}}
    </switchletter>
@endsection