<!DOCTYPE html>
<html lang="en">
<head>
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
</head>
<body>
    <div class="container">
        <p id="dtext"><strong>Gedownload op:  {{ $date }}</strong></p>
        <div class="brief-header"><img id="logo" src="https://www.enercon.de/fileadmin/Resources/Public/img/enercon_en.png"/></div>
        <div class="schakelbrief">
            <h2> Briefnr: (#{{ $SL->briefnr }})</h2>
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
            <br><br>
            <h3 style="text-align: center;">Stappen</h3>
            <table style="align-text: center; width: 100%;">
                <tr style="padding: 10px;">
                    <th>Stap</th>
                    <th>Plaats</th>
                    <th>Veld</th>
                    <th>Turbine</th>
                    <th>Omschrijving</th>
                </tr>
                <?php $i = 0; ?>
                    @foreach($stappen as $stap)
                    <tr>
                    <td> <?php echo ++$i; ?></td>
                    <td> {{ $stap->plaats }} </td>
                    <td> {{ $stap->veld}} </td>
                    <td> {{ $stap->turbine }} </td>
                    <td> {{ $stap->omschrijving }} </td>
                    </tr>
                    @endforeach
                
            </table>

            <br><br><br><br><br>
            <hr style="color: #00564c;">
            <label for="go-nl"><strong>Opmerking GO-NL</strong>:<br>
                {{ $SL->remarks }}
            <hr style="color: #00564c;">
            <br><br><br>
            <hr style="color: #00564c;">
            <label for="werkzaamheden"><strong>Opmerkingen tijdens werkzaamheden</strong>:<br>
                {{ $SL->plremarks }} 
            <hr style="color: #00564c;">
            

        </div>
    </div>
</body>
</html>