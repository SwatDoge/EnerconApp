@extends('layouts.app')
@section('content')
@csrf
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <switchletter></switchletter>
@endsection