<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uren en Taken Overzicht - Stage 2, 2024</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            width: 10%;
        }

        th {
            background-color: #f2f2f2;
        }

        .signature-box {
            border: 1px solid #dddddd;
            height: 30px; /* Adjust the height as needed */
            width: 100%;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        Uren en Taken Overzicht - {{ $userName }}, Stage 2, 2024
    </div>

    <!-- Tabel voor weergave van gewerkte uren en taken -->
    <table>
        <thead>
            <div>
                <strong>Praktijkopleider:</strong> {{ $settings->praktijkopleider }}
            </div>
            <div>
                <strong>Stagebegeleider:</strong> {{ $settings->stagebegeleider }}
            </div>
            <div>
                <strong>Leerbedrijf:</strong> {{ $settings->leerbedrijf }} </div> <br>

            <tr>
                <th>Datum</th>
                <th>Starttijd</th>
                <th>Eindtijd</th>
                <th>Pauze</th>
                <th>Gewerkte Uren</th>
                <th>Taken</th>
                <th>Bijzonderheden</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workedHours as $workhour)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($workhour->datum)->format('d-m-Y') }}</td>
                    <td>{{ $workhour->start_tijd }}</td>
                    <td>{{ $workhour->eind_tijd }}</td>
                    <td>{{ $workhour->pauze }}</td>
                    <td>{{ $workhour->gewerkte_uren }}</td>
                    <td>{{ $workhour->taken }}</td>
                    <td>{{ $workhour->bijzonderheden }}</td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
    <strong>Totaal gewerkte uren:</strong> {{ $totalWorkedHours }}
</div>

    <!-- Aftekenvak -->
    <div class="signature-box">
        Handtekening praktijkopleider: __________________________
    </div>

  

</body>
</html>
