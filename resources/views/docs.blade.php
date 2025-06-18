<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation de l'API de Présence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .route-table th, .route-table td { vertical-align: middle; }
        h2 { margin-top: 2rem; }
    </style>
</head>
<body>
<div class="container py-4">
    <h1 class="mb-4 text-center">Documentation de l'API Présence</h1>
    <p class="lead text-center">Ce projet permet d'envoyer les présences des utilisateurs selon leur localisation.</p>

    <h2>Routes API</h2>
    <table class="table table-bordered route-table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Méthode</th>
                <th>URI</th>
                <th>Nom</th>
                <th>Middleware</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        @foreach($apiRoutes as $route)
            <tr>
                <td><span class="badge bg-primary">{{$route['methods']}}</span></td>
                <td><code>{{$route['uri']}}</code></td>
                <td>{{$route['name']}}</td>
                <td>{{$route['middleware']}}</td>
                <td>{{$route['description']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Routes Web</h2>
    <table class="table table-bordered route-table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Méthode</th>
                <th>URI</th>
                <th>Nom</th>
                <th>Middleware</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
        @foreach($webRoutes as $route)
            <tr>
                <td><span class="badge bg-secondary">{{$route['methods']}}</span></td>
                <td><code>{{$route['uri']}}</code></td>
                <td>{{$route['name']}}</td>
                <td>{{$route['middleware']}}</td>
                <td>{{$route['description']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <footer class="mt-5 text-center text-muted">
        &copy; {{ date('Y') }} Présence API. Généré automatiquement.
    </footer>
</div>
</body>
</html>
