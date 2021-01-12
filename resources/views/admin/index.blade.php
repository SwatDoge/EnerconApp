@extends('layouts.app')

@section('content')
    <html>
        <link rel="icon" href="{{ URL::asset('/css/favicon.jpg') }}" type="image/x-icon"/>
        <body>
            <div class="container p-5">
                @if($users->count() > 0)
                    <table id="admin_table_id" class="table p-5 text center display" data-paging='false'>
                        <h1>Gebruikers</h1><br>
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
                            <?php
                                $u = App\Models\UserRole::all()->where('user_id', $user->id )->pluck('role_id')->first();
                            ?>
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                @if(empty($u))
                                    <td><b>Geen rol :(</b></td>
                                @else
                                    @foreach (App\Models\Roles::all()->where('id', $u) as $role)
                                        <td><b>{{ $role->role }}</b></td>
                                    @endforeach
                                @endif
                                <td class="d-flex flex-row justify-content-between">
                                    <a href="{{ route('aEdit', $user->id) }}">
                                        <button style="margin: 0" type="button" class="btn bg-green">
                                            <i class="far fa-edit white"></i>
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
                <br>
                {{ $users->links() }}
            </div>
            <style>
                .w-5 {
                    display: none;
                }
            </style>
        </body>
    </html>
    @push('scripts')
        <script>
            $(document).ready( function () {
                $('#admin_table_id').DataTable({
                    columnDefs: [
                        { orderable: false, targets: -1 }
                    ],
                    "bInfo" : false,

                });

            } );
        </script>
    @endpush

@endsection
