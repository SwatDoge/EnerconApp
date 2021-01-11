@extends('layouts.app')
@section('content')
    <style>
        html { scroll-behavior: smooth; }
    </style>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <form method="POST" action="http://127.0.0.1:8000/sl/update/{{$SL->id}}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        {{-- Schakelbrief gegevens --}}
    <div class="card mx-4">
        <div class="card-body">

            <div class="row">
                <div class="col pr-0">
                    <h2>Nieuwe schakelbrief {{$SL->briefnr}}</h2>
                    <br/>
                    <h4>Algemeen</h4>
                    <hr/>
                </div>
                <div class="col-md-offset-4 mr-3">
                    <img src="/img/logo_transparent.png" height=92>
                    <hr/>
                </div>
            </div>


            <div class="form-group row mb-0">
                <div class="col ml-3">
                    <div class="row">
                        <input placeholder="Windpark naam" name="windpark" type="text" value="{{$SL->windpark}}" class="form-control mb-1" id="windpark">
                    </div>
                    <div class="row">
                        <input placeholder="Datum" name="date" type="text" value="(Datum van vandaag als default)" class="form-control mb-1" id="date">
                    </div>
                    <div class="row">
                        <textarea placeholder="Rederene voor schakeling" style="height: 110px;" name="reason" value="" id="reason" class="form-control">{{$SL->reason}}</textarea>
                        <br/>
                    </div>
                </div>
                <div class="col">
                    {{-- schakelbedrijf gegevens --}}
                    <div class="form-group row mb-0">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <label for="switchcompany">Schakelbedrijf:</label>
                                    <input placeholder="Bedrijfsnaam" name="switchcompany" type="text" value="{{$SL->bedrijf}}" id="switchcompany" class="form-control">
                                    </br>
                                    <input placeholder="Telefoon nummer" name="switchtel" type="text" value="{{$SL->bedrijftel}}" id="switchtel" class="form-control">
                                    </br>
                                </div>
                            </div>
                        </div>
                        {{-- contactpersoon gegevens --}}
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <label for="contactname">Contactpersoon:</label>
                                    <input placeholder="Naam Contactpersoon" name="contactname" type="text" value="{{$SL->contact}}" id="contactname" class="form-control">
                                    </br>
                                    <input placeholder="Telefoon nummer" name="contacttel" type="text" value="{{$SL->contacttel}}" id="contacttel" class="form-control">
                                    </br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br/>
            <br/>
            <br/>
            <h4>Intern</h4>
            <hr/>

            <div class="form-group row">
                {{-- IV gegevens --}}
                <div class="col">
                    <div class="mb-4">
                        <label for="ivname">Instalatie verantwoordlijke:</label>
                            <input placeholder="Naam" type="text" value="{{$SL->ivname}}" class="form-control" id="ivname" name="ivname">
                            <input placeholder="Telefoon nummer" name="ivtel" type="text" value="{{$SL->ivtel}}" id="ivtel" class="form-control mt-1" readonly>
                        </br>
                    </div>
                </div>

                {{-- MV gegevens --}}
                <div class="col">
                    <div class="mx-4 mb-4">
                        <label for="mvname">Werk verantwoordelijke:</label>
                        <input placeholder="Naam" type="text" value="{{$SL->mvname}}" class="form-control" id="mvname" name="mvname">
                        <input placeholder="Telefoon nummer" name="mvtel" type="text" value="{{$SL->mvtel}}" id="mvtel" class="form-control mt-1" readonly>
                        </br>
                    </div>
                </div>

                {{-- PL gegevens --}}
                <div class="col">
                    <div class="mx-4 mb-4">
                        <label for="plname">Ploeglijder: </label>
                        <input placeholder="Naam" type="text" value="{{$SL->plname}}" class="form-control" id="plname" name="plname">
                        <input placeholder="Telefoon nummer" name="pltel" type="text" value="{{$SL->pltel}}" id="pltel" class="form-control mt-1" readonly>
                        </br>
                    </div>
                </div>
            </div>

            <br/>
            <h4>Stappen</h4>

            <div class="card">
                <div class="card-body">
                    <div class="row text-center align-middle">
                        <div class="col">Stap</div>
                        <div class="col">Turbine</div>
                        <div class="col">Plaats</div>
                        <div class="col">Veld</div>
                        <div class="col">Datum/Tijd</div>
                        <div class="col">Omschrijving</div>
                        <div class="col">Voltooid</div>
                        <div class="col">Acties</div>
                    </div>
                    <hr/>
                    <div class="row text-center align-items-center">
                        <div class="col">
                            <input type="text" class="form-control text-center" placeholder="Stap" value="1">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" placeholder="Turbine" value="3">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" placeholder="Plaats" value="Drenthe">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" placeholder="Vled" value="2">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control text-center" placeholder="Datum" value="1/2/1020">
                        </div>
                        <div class="col">
                            <a data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Zie omschrijving 👁</a>
                        </div>
                        <div class="col">
                            <input type="checkbox">
                        </div>
                        <div class="col">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                    <div class="row collapse mt-2" id="collapseExample">
                        <div class="col">
                            <textarea class="form-control"> pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <a type="button" class="btn btn-secondary mt-2">Nieuwe stap aanmaken</a>

            <br/>
            <br/>
            <br/>
            <h4>Opmerkingen</h4>
            <hr/>

            {{-- Reden en opmerkingen --}}
            <div class="form-group row">
                <div class="col no-gutters">
                    <label for="remarks">Opmerking GO-NL: </label>
                    <textarea style="width: 100; height: 150px;" name="remarks" value="" id="remarks" class="form-control">{{$SL->reason}}</textarea>
                    <br/>
                </div>
                <div class="col no-gutters">
                    <label for="reason">Opmerkingen tijdens werkzaamheden: </label>
                    <textarea style="width: 100%; height: 150px;" name="plremarks" value="" id="plremarks" class="form-control"></textarea>
                    <br/>
                </div>
            </div>

            <input class="btn btn-primary" type="submit" value="Update">

        </div>
    </div>
</form>
@endsection