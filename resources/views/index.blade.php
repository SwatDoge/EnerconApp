@extends('layouts.app', ['title' => 'Home'])

@section('content')
    <html>
        <body>
            <div class="container p-5 text-center">
                <img src="/img/logo_transparent.png" width="40%" height="40%" class="pb-5">
                <br>
                <div class="row">
                    <div class="col-12 col-md-6 blok-menu p-0">
                        <div class="blok-menu-inner bg-green m-2" style="cursor: pointer;" onclick="window.location='{{ route('pIndex') }}';">
                            <a class="menu-icon" href="{{ route('pIndex') }}"><i class="fas fa-user-alt"></i></a>
                            <a class="menu-item" href="{{ route('pIndex') }}">Profiel</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 blok-menu p-0">
                        <div class="blok-menu-inner bg-dark m-2" style="cursor: pointer;" onclick="window.location='{{ route('aIndex') }}';">
                            <a class="menu-icon"  href="{{ route('aIndex') }}"><i class="fas fa-users-cog"></i></a>
                            <a class="menu-item" href="{{ route('aIndex') }}">Admin</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 blok-menu p-0">
                        <div class="blok-menu-inner bg-dark m-2" style="cursor: pointer;" onclick="window.location='{{ route('slIndex') }}';">
                            <a class="menu-icon" href="{{ route('slIndex') }}"><i class="fas fa-envelope-open-text"></i></a>
                            <a class="menu-item" href="{{ route('slIndex') }}">Schakelbrieven</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 blok-menu p-0">
                        <div class="blok-menu-inner bg-green m-2" style="cursor: pointer;" onclick="window.location='{{ route('rIndex') }}';">
                            <a class="menu-icon" href="{{ route('rIndex') }}"><i class="fas fa-list"></i></a>
                            <a class="menu-item" href="{{ route('rIndex') }}">Rollen</a>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    </html>

@endsection
