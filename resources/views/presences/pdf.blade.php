<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport des Présences</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FFFFFF;
            color: #000000;
        }
        .header {
            text-align: center;
            padding: 20px 10px;
            background-color: #F0F0F0;
            border-bottom: 1px solid #CCCCCC;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }
        .table-container {
            margin: 20px auto;
            padding: 0 10px;
            max-width: 1000px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            border: 1px solid #CCCCCC;
        }
        table th {
            background-color: #EAEAEA;
            font-weight: bold;
            text-transform: uppercase;
            color: #000000;
        }
        table tbody tr:nth-child(odd) {
            background-color: #F9F9F9;
        }
        .statut {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #CCCCCC;
        }
        .statut-present {
            background-color: #FFFFFF;
            color: #000000;
        }
        .statut-retard {
            background-color: #F0F0F0;
            color: #000000;
        }
        .statut-absent {
            background-color: #EAEAEA;
            color: #000000;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            background-color: #F0F0F0;
            border-top: 1px solid #CCCCCC;
            font-size: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>Rapport des Présences</h1>
        <p>Filtre appliqué : Date = {{ request('date', 'N/A') }}, Statut = {{ request('status', 'Tous') }}</p>
    </div>

    <!-- Tableau des données -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Lieu</th>
                    <th>Date/Heure</th>
                    <th>Type</th>
                    <th>Distance</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presences as $presence)
                <tr>
                    <td>{{ $presence->utilisateur->matricule }}</td>
                    <td>{{ $presence->utilisateur->name }}</td>
                    <td>{{ $presence->utilisateur->lieu->nom }}</td>
                    <td>{{ \Carbon\Carbon::parse($presence->date)->format('d/m/Y H:i:s') }}</td>
                    <td>{{ $presence->type == 1 ? 'Arrivée' : 'Départ' }}</td>
                    <td>{{ number_format($presence->distance, 2) }} m</td>
                    <td>
                        <span class="statut 
                            {{ $presence->statut === 'Présent et à l\'heure' ? 'statut-present' : 
                               ($presence->statut === 'Présent mais en retard' ? 'statut-retard' : 'statut-absent') }}">
                            {{ $presence->statut }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        Rapport généré le {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
    </div>
</body>
</html>
