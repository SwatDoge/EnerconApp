@extends('layouts.app')

@section('content')
<html>
    <body>
        <div class="container p-5">
            @if($switchbrief->count() > 0)
            <table id="table_id" class="table p-7 text-center display" data-paging='false'>
                <h1>Schakelbrieven</h1>
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
                        <td>
                            <a href="/sl/{{$brief->id}}/edit" class="">
                                <button style="margin: 0" type="button" class="btn bg-green color-white">
                                    <i class="far fa-edit white"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p>Nog geen schakelbrieven toegevoegd</p>
            @endif
            <br>
            <a href="{{ route('slCreate') }}" class="btn bg-green white">Schakelbrief toevoegen</a>
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
