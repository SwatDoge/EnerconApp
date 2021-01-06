@extends('layouts.app')
@section('content')
    <style>
        html { scroll-behavior: smooth; }
    </style>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <h2>Maak Schakelbrief</h2>
    <form method="POST" action="http://127.0.0.1:8000/sl" accept-charset="UTF-8" enctype="multipart/form-data"><input name="_token" type="hidden" value="ubyukr8tPd6jg4EW2E8gEcWGj4aZlCIglxlsZkt0" id="SLcreateform">
        {{-- Schakelbrief gegevens --}}
        <div class="form-group">
            <label for="schakelbriefnr">Schakelbriefnr.: </label>
            <input placeholder="Schakelbriefnr" name="schakelbriefnr" type="text" value="" id="schakelbriefnr"><br>
            <label for="windpark">Windpark naam: </label>
            <input placeholder="windpark" name="windpark" type="text" value="" id="windpark"><br>
            <label for="date">Datum Werkzaamheden: </label>
            <input placeholder="datum" name="date" type="text" value="" id="date">
        </div>

        <div>
            {{-- IV gegevens --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="ivname">Naam IV: </label>
                <input placeholder="IV" name="ivname" type="text" value="" id="ivname"><br>
                <label for="ivtel">Tel Nr.: </label>
                <input placeholder="Tel nr." name="ivtel" type="text" value="" id="ivtel"><br>
            </div>
        
            {{-- MV gegevens --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="mvname">Naam MV: </label>
                <input placeholder="MV" name="mvname" type="text" value="" id="mvname"><br>
                <label for="mvtel">Tel Nr.: </label>
                <input placeholder="Tel nr." name="mvtel" type="text" value="" id="mvtel"><br>
            </div>

            {{-- PL gegevens --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="plname">Naam PL: </label>
                <input placeholder="PL" name="plname" type="text" value="" id="plname"><br>
                <label for="pltel">Tel Nr.: </label>
                <input placeholder="Tel nr." name="pltel" type="text" value="" id="pltel"><br>
            </div>
        </div>
        
        <div>    
            {{-- schakelbedrijf gegevens --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="switchcompany">Schakelbedrijf: </label>
                <input placeholder="Bedrijfsnaam" name="switchcompany" type="text" value="" id="switchcompany"><br>
                <label for="switchtel">Tel Nr.: </label>
                <input placeholder="Tel nr." name="switchtel" type="text" value="" id="switchtel"><br>
            </div>
            
            {{-- contactpersoon gegevens --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="contactname">Contactpersoon: </label>
                <input placeholder="Naam Contactpersoon" name="contactname" type="text" value="" id="contactname"><br>
                <label for="contacttel">Tel Nr.: </label>
                <input placeholder="Tel nr." name="contacttel" type="text" value="" id="contacttel">
            </div>
        </div>

        <div>
            {{-- Akkoord IV --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="ivaccept">Akkoord: </label>
                <input name="ivaccept" type="checkbox" value="value" id="ivaccept">
            </div>

            {{-- Akkoord MV --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="mvaccept">Akkoord: </label>
                <input name="mvaccept" type="checkbox" value="value" id="mvaccept">
            </div>
            
            {{-- Akkoord PL --}}
            <div class="form-group" style="display: inline-block; width: 300px; padding:0px 4px;">
                <label for="placcept">Akkoord: </label>
                <input name="placcept" type="checkbox" value="value" id="placcept">
            </div>
        </div>

        {{-- Reden en opmerkingen --}}
        <div class="form-group">
            <label for="remarks">opmerkingen GO-NL: </label>
            <input placeholder="Opmerking" style="width: 750px" name="remarks" type="text" value="" id="remarks"><br>
            <label for="reason">Reden voor schakeling: </label>
            <input placeholder="reden" style="width: 750px" name="reason" type="text" value="" id="reason"><br>
        </div>

        {{-- tabel? --}}
        <div class="form-group">
            <table>
            </table>
        </div>

        {{-- opmerkingen --}}
        <div class="form-group">
            <label for="plremarks">opmerkingen tijdens werkzaamheden: </label>
            <textarea placeholder="Opmerking" style="width: 650px; height: 100px" name="plremarks" type="textarea" value="" id="plremarks" form="SLcreateform"></textarea>
        </div>

        <input class="btn btn-primary" type="submit" value="Akkoord">
    </form>
@endsection


{{-- select box to db (laat dit ff onderraan staan pls) --}}
        {{-- <div class="form-group">
            <label for="type">Select the type of post</label>
            <select id="type" name="type">
                <option value="" selected="selected">placeholder</option>
                <option value="test">test</option>
            </select>
        </div> --}}