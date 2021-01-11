@extends('layouts.app')

@section('content')
<html>
    <body>
        <div class="container p-5">
            @if($switchbrief->count() > 0)
            <table id="table switchbriefs_table_id" class="table p-7 text-center display" data-paging='false'>
                <h1>Schakelbrieven</h1>
                <thead>
                <tr>
                    <th scope="col">Briefnr</th>
                    {{-- <th scope="col">Windpark</th> --}}
                    <th scope="col">Datum</th>
                    <th scope="col">IV Naam</th>
                    {{-- <th scope="col">IV Telnr</th>
                    <th scope="col">MV Naam</th>
                    <th scope="col">MV Telnr</th>
                    <th scope="col">PL Naam</th>
                    <th scope="col">PL Telnr</th> --}}
                    <th scope="col">Bedrijf</th>
                    {{-- <th scope="col">Bedrijf Telnr</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Contact Telnr</th>
                    <th scope="col">Opmerkingen</th>
                    <th scope="col">Reden</th> --}}
                    <th scope="col">Acties</th>

                </tr>
                </thead>
                <tbody>
                @foreach($switchbrief as $brief)
                    <tr>
                        <td>{{$brief->briefnr}}</td>
                        {{-- <td>{{$brief->windpark}}</td> --}}
                        <td>{{$brief->date}}</td>
                        <td>{{$brief->ivname}}</td>
                        {{-- <td>{{$brief->ivtel}}</td> --}}
                        {{-- <td>{{$brief->mvname}}</td>
                        <td>{{$brief->mvtel}}</td>
                        <td>{{$brief->plname}}</td>
                        <td>{{$brief->pltel}}</td> --}}
                        <td>{{$brief->bedrijf}}</td>
                        {{-- <td>{{$brief->bedrijftel}}</td>
                        <td>{{$brief->contact}}</td>
                        <td>{{$brief->contacttel}}</td> --}}
                        {{-- <td>
                            @if($brief->remarks == null)
                                Geen opmerkingen
                            @else
                            {{$brief->remarks}}
                            @endif
                        </td>
                        <td>
                            @if($brief->reason == null)
                            Geen reden
                            @else
                            {{$brief->reason}}
                            @endif
                        </td> --}}
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
            <a href="{{ route('slCreate') }}" class="btn bg-green white">Schakelbrief toevoegen</a>
        </div>
    </body>
</html>
    @push('scripts')
        <script>
            $(document).ready( function () {
                $('#switchbriefs_table_id').DataTable({
                    columnDefs: [
                        { orderable: false, targets: -1 }
                    ],
                    "bInfo" : false,

                });

            } );
        </script>
    @endpush

@endsection
