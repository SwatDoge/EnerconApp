@extends('layouts.app')

@section('content')
<html>
    <body>
        <div class="container p-5">
            <div class="pb-2">
                <a class="btn bg-green white d-flex justify-content-center" href="{{route('slCreate')}}">
                    Schakelbrief toevoegen
                </a>
            </div>
            @if($switchbrief->count() > 0)
            <div class="card">
                <table id="table_id" class="table p-7 text-center display" data-paging='false'>
                    <h1 class="card-header">Schakelbrieven</h1>
                    <br>
                    <thead>
                        <tr>
                            <th scope="col">Briefnr</th>
                            <th scope="col">Datum</th>
                            <th scope="col">IV Naam</th>
                            <th scope="col">Bedrijf</th>
                            <th scope="col">Acties</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($switchbrief as $brief)
                        <tr>
                            <td>{{$brief->briefnr}}</td>
                            <td>{{$brief->date}}</td>
                            <td>{{$brief->ivname}}</td>
                            <td>{{$brief->bedrijf}}</td>
                            <td class="d-flex flex-row justify-content-between">
                                <a href="{{ route('slEdit', $brief->id) }}">
                                    <button style="margin: 0" type="button" class="btn bg-green">
                                        <i class="far fa-edit white"></i>
                                    </button>
                                </a>
                                <form action="{{ route('slDelete', $brief->id) }}" method="POST">
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
            <p>Nog geen schakelbrieven toegevoegd</p>
            @endif
        </div>
    </body>
</html>
@push('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable({
                columnDefs: [
                    { orderable: false, targets: -1 }
                ],
                "bInfo" : false,

            });

        } );
    </script>
@endpush

@endsection
