@extends('layouts.app')

@section('content')
    <div class="container p-7">
        @if($switchbrief->count() > 0)
        <table id="table" class="table p-7 text-center">
            <h1>Schakelbrieven</h1>
            <thead>
            <tr>
                <th scope="col">Briefnr</th>
                <th scope="col">Datum</th>
                <th scope="col">IV Naam</th>
                <th scope="col">Bedrijf</th>
                <th scope="col">PDF</th>
                <th scope="col">Word</th>
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
                        <a class="btn btn-danger" href="{{ route('slPDF', $brief->id) }}">Export PDF</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('slWord', $brief->id) }}">Export Word</a>
                    </td>
                    <td>
                        <a href="/sl/{{$brief->id}}/edit" class="">
                            <button style="margin: 0" type="button" class="btn bg-green color-white">
                                <i class="far fa-edit white"></i>
                            </button>
                        </a>
                    </td>
            @endforeach
                </tbody>
            </table>
            @else
            <p>Nog geen schakelbrieven toegevoegd</p>
            @endif
            <a href="{{ route('slCreate') }}" class="btn bg-green white">Schakelbrief toevoegen</a>
        </div>
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
