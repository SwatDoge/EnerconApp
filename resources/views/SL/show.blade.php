@extends('layouts.app')
@section('content')
    <style>
        .container {
            margin: 0;
            padding: 0;
        }
        #dtext {
            position: absolute;
            float: left;
            top: 0;
            font-size: 9px;
        }
        #logo {
            float: right;
            width: 300px;
            height: 50px;
        }

        td {
            text-align: center;
        }

        th, td {
            border-bottom: 1px solid #ddd;
        }
    </style>
    <div class="container">
        <div class="brief-header"><img id="logo" src="https://www.enercon.de/fileadmin/Resources/Public/img/enercon_en.png"/></div>
        <div class="schakelbrief">
            <h2> Briefnr: (#{{ $SL->id }})</h2>
            <p><strong>Reden voor schakelbrief</strong>: {{ $SL->reason }}
            <hr style="color: #00564c;">
            <p> Windparknaam: {{ $SL->windpark }}</p>
            <p>Datum van aanmaak: {{ $SL->date }}</p>
            <table style="float: left; border: 1px solid #00564c">
                <tr>
                    <th>Schakelbedrijf info</th>
                </tr>
                <tr>
                    <td>Bedrijfsnaam: {{ $SL->bedrijf }} </td>
                </tr>
                <tr>
                    <td>Bedrijfsnummer: {{ $SL->bedrijftel }} </td>
                </tr>
            </table>

            <table style="float: right; border: 1px solid #00564c">
                <tr>
                    <th>Contactpersoon info</th>
                </tr>
                <tr>
                    <td>Contactpersoon: {{ $SL->contact }} </td>
                </tr>
                <tr>
                    <td>Contact telefoon: {{ $SL->contacttel }} </td>
                </tr>
            </table>
            <br><br><br><br><br>
            <hr style="color: #00564c;">
            <h3 style="text-align: center;">Intern</h3>
            
            <table style="align-text: center; width: 100%;">
                <tr style="padding: 10px;">
                    <th>Installatieverantwoordelijke</th>
                    <th>Werkverantwoordelijke</th>
                    <th>Ploegleider</th>
                </tr>
                <tr>
                    <td>{{ $SL->ivname }}</td>
                    <td>{{ $SL->mvname }}</td>
                    <td>{{ $SL->plname }}</td>
                </tr>
                <tr>
                    <td>{{ $SL->ivtel }}</td>
                    <td>{{ $SL->mvtel}}</td>
                    <td>{{ $SL->pltel }}</td>
                </tr>
            </table>
            <hr style="color: #00564c;">

            <br><br><br><br><br>
            <label for="go-nl">Opmerking GO-NL:
            <textarea name="go-nl" style="border: 1px solid #00564c;">
                {{ $SL->remarks }}
            </textarea>
            <br><br><br>
            <label for="werkzaamheden">Opmerkingen tijdens werkzaamheden:
            <textarea name="werkzaamheden" style="border: 1px solid #00564c;">
                {{ $SL->plremarks }}
            </textarea>

        </div>
    </div>
@endsection