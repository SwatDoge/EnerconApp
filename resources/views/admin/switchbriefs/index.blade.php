@extends('layouts.app')

@section('content')
<html>
    <body>
        <div class="container p-5">
            <h1>Schakelbrieven</h1>
            @if(count($switchbrief) > 0)
            <div class="card">
            <table id="table switchbriefs_table_id" class="table p-7 text-center display" data-paging='false'>
                <thead>
                <tr>
                    <th scope="col">Briefnr</th>
                    <th scope="col">Datum</th>
                    <th scope="col">IV Naam</th>
                    <th scope="col">Bedrijf</th>

                </tr>
                </thead>
                <tbody>
                @foreach($switchbrief as $brief)
                    <tr>
                        <td> <a href="/sl/{{$brief->id}}"  class="button alt">{{$brief->id}}</a></td>
                        <td>{{$brief->date}}</td>
                        <td>{{$brief->ivname}}</td>
                        <td>{{$brief->bedrijf}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <p>Nog geen schakelbrieven toegevoegd</p>
            @endif
        </div>
            <a href="{{ route('slCreate') }}" class="btn bg-green white">Schakelbrief toevoegen</a>
        </div>


        <div class="container p-5">
            <h1>Mijn Schakelbrieven</h1>
            <div class="card">
            <table id="table switchbriefs_table_id" class="table p-7 text-center display" data-paging='false'>
                <thead>
                <tr>
                    <th scope="col">Briefnr</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Jouw Rol</th>
                    <th scope="col">Bedrijf</th>
                    <th scope="col">Acties</th>

                </tr>
                </thead>


                @if(count($iv) > 0)
                <tbody>
                @foreach($iv as $IV)
                    <tr>
                        <td> <a href="/sl/{{$IV->id}}"  class="button alt">{{$IV->id}}</a></td>
                        <td>{{$IV->date}}</td>
                        <td>IV</td>
                        <td>{{$IV->bedrijf}}</td>
                        <td>
                            <?php if (Auth::user()->name == $IV->ivname && $IV->ivakkoord == 0) { ?>
                                <a href="/sl/{{$IV->id}}/edit" class="">
                                    <button style="margin: 0" type="button" class="btn bg-green color-white">
                                        <i class="far fa-edit white"></i>
                                    </button>
                                </a>
                            <?php } elseif (Auth::user()->name == $IV->mvname && $IV->ivakkoord == 1 && $IV->mvakkoord == 0) { ?>
                                <a href="/sl/{{$IV->id}}/edit" class="">
                                    <button style="margin: 0" type="button" class="btn bg-green color-white">
                                        <i class="far fa-edit white"></i>
                                    </button>
                                </a>
                            <?php } elseif (Auth::user()->name == $IV->plname && $IV->ivakkoord == 1 && $IV->mvakkoord == 1 && $IV->plakkoord == 0) { ?>
                                <a href="/sl/{{$IV->id}}/edit" class="">
                                    <button style="margin: 0" type="button" class="btn bg-green color-white">
                                        <i class="far fa-edit white"></i>
                                    </button>
                                </a>
                            <?php } else { ?>
                                <a href="#" class="" disabled>
                                    <button style="margin: 0" type="button" class="btn bg-green color-white" disabled>
                                        <i class="far fa-edit white"></i>
                                    </button>
                                </a> 
                            <?php } ?>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @endif


            @if(count($wv) > 0)
                <tbody>
                    @foreach($wv as $WV)
                        <tr>
                            <td> <a href="/posts/{{$WV->id}}"  class="button alt">{{$WV->id}}</a></td>
                            <td>{{$WV->date}}</td>
                            <td>WV</td>
                            <td>{{$WV->bedrijf}}</td>
                            <td>
                                <?php if (Auth::user()->name == $WV->ivname && $WV->mvakkoord == 0) { ?>
                                    <a href="/sl/{{$WV->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } elseif (Auth::user()->name == $WV->mvname && $WV->ivakkoord == 1 && $WV->mvakkoord == 0) { ?>
                                    <a href="/sl/{{$WV->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } elseif (Auth::user()->name == $WV->plname && $WV->ivakkoord == 1 && $WV->mvakkoord == 1 && $WV->plakkoord == 0) { ?>
                                    <a href="/sl/{{$WV->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <a href="#" class="" disabled>
                                        <button style="margin: 0" type="button" class="btn bg-green color-white" disabled>
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a> 
                                <?php } ?>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif


            @if(count($pl) > 0)
                <tbody>
                    @foreach($pl as $PL)
                        <tr>
                            <td> <a href="/posts/{{$PL->id}}"  class="button alt">{{$PL->id}}</a></td>
                            <td>{{$PL->date}}</td>
                            <td>PL</td>
                            <td>{{$PL->bedrijf}}</td>
                            <td>
                                <?php if (Auth::user()->name == $PL->ivname && $PL->plakkoord == 0) { ?>
                                    <a href="/sl/{{$PL->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } elseif (Auth::user()->name == $PL->mvname && $PL->ivakkoord == 1 && $PL->mvakkoord == 0) { ?>
                                    <a href="/sl/{{$PL->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } elseif (Auth::user()->name == $PL->plname && $PL->ivakkoord == 1 && $PL->mvakkoord == 1 && $PL->plakkoord == 0) { ?>
                                    <a href="/sl/{{$PL->id}}/edit" class="">
                                        <button style="margin: 0" type="button" class="btn bg-green color-white">
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a>
                                <?php } else { ?>
                                    <a href="#" class="" disabled>
                                        <button style="margin: 0" type="button" class="btn bg-green color-white" disabled>
                                            <i class="far fa-edit white"></i>
                                        </button>
                                    </a> 
                                <?php } ?>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif


            @if(count($iv) == 0 && count($wv) == 0 && count($pl) == 0)
            <p>U heeft momenteel geen schakelbrieven aan uw account gebonden</p>
            @endif
        </table>
    </div>
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
