@extends('layouts.app')

@section('content')
    <html>
        <body>
            <div class="container p-5">
                @if($users->count() > 0)
                    <table id="table" class="table p-5">
                        <h1>Gebruikers</h1>
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naam</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rollen</th>
                            <th scope="col">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @foreach ($roles->where('id', $user->id) as $role)
                                    {{ $role }}
                                @endforeach
                                <td class="d-flex flex-row justify-content-between">
                                    <a href="{{ route('aEdit', $user->id) }}">
                                        <button style="margin: 0" type="button" class="btn btn-primary">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </a>
                                    <form action="{{ route('aDelete', $user) }}" method="POST">
                                        @csrf @method('delete')
                                        <button style="border-radius: 0" type="submit" class="btn btn-warning">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="p-5">Nog geen gebruikers</p>
                @endif
                {{ $users->onEachSide(5)->links() }}
            </div>
        </body>
    </html>
@endsection
