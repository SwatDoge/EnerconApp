@extends('layouts.app')

@section('content')
    <html>
        <link rel="icon" href="{{ URL::asset('/css/favicon.jpg') }}" type="image/x-icon"/>
        <body>
            <div class="container p-5">
                <div class="pb-2">
                    <a class="btn bg-green white d-flex justify-content-center" href="{{route('aCreate')}}">
                        Gebruiker toevoegen
                    </a>
                </div>
                @if($users->count() > 0)
                <div class="card">
                    <table id="admin_table_id" class="table p-7 text center display" data-paging='false'>
                        <h1 class="card-header">Gebruikers</h1><br>
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
                    <div class="card-footer">
                    </div>
                </div>
                @else
                    <p class="p-5">Nog geen gebruikers</p>
                @endif
                <br>
                {{ $users->links() }}
                <br>
                <a class="btn bg-green white float-right" href="{{route('aCreate')}}">
                    Gebruiker toevoegen
                </a>
            <style>
                .w-5 {
                    display: none;
                }
            </style>
        </body>
    </html>
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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

        </div>
    </div>
</div>
@endsection
