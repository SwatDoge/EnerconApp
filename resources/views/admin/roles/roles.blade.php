@extends('layouts.app')

@section('content')
<div class="container p-5">
    @if($roles->count() > 0 )
    <table id="table" class="table p-5 text-center">
        <h1>Rollen</h1>
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Rolnaam</th>
            <th scope="col">Acties</th>
        </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->role}}</td>
                    <td class="d-flex flex-row justify-content-between">
                        <a href="/admin/roles/{{$role->id}}/edit">
                            <button style="margin: 0" type="button" class="btn bg-green">
                                <i class="far fa-edit white"></i>
                            </button>
                        </a>
                        <form action="/admin/roles/delete/{{$role->id}}" method="POST">
                            @csrf
                            <button style="border-radius: 0" type="submit" class="btn btn-warning">
                                <i class="fas fa-trash white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nog geen rollen toegevoegd</p>
    @endif
    <a href="/admin/roles/addrole" class="btn bg-green white">Rol toevoegen</a>
@endsection
