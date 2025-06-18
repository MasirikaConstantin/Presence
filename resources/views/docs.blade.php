<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation de l'API de Présence</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        comfortaa: ['Comfortaa', 'sans-serif'],
                        dancing: ['Dancing Script', 'cursive']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <h1 class="mb-6 text-3xl font-bold text-center font-comfortaa text-gray-800">Documentation de l'API Présence</h1>
    <p class="text-xl text-center text-gray-600 mb-8 font-comfortaa">Ce projet permet d'envoyer les présences des utilisateurs selon leur localisation.</p>

    <h2 class="text-2xl font-bold mt-8 mb-4 text-gray-700 border-b pb-2">Routes API</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">Méthode</th>
                    <th class="py-3 px-4 text-left font-medium">URI</th>
                    <th class="py-3 px-4 text-left font-medium">Nom</th>
                    <th class="py-3 px-4 text-left font-medium">Middleware</th>
                    <th class="py-3 px-4 text-left font-medium">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($apiRoutes as $route)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{$route['methods']}}
                        </span>
                    </td>
                    <td class="py-3 px-4 font-mono text-sm text-gray-700">
                        {{$route['uri']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['name']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['middleware']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['description']}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="text-2xl font-bold mt-12 mb-4 text-gray-700 border-b pb-2">Routes Web</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left font-medium">Méthode</th>
                    <th class="py-3 px-4 text-left font-medium">URI</th>
                    <th class="py-3 px-4 text-left font-medium">Nom</th>
                    <th class="py-3 px-4 text-left font-medium">Middleware</th>
                    <th class="py-3 px-4 text-left font-medium">Description</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach($webRoutes as $route)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{$route['methods']}}
                        </span>
                    </td>
                    <td class="py-3 px-4 font-mono text-sm text-gray-700">
                        {{$route['uri']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['name']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['middleware']}}
                    </td>
                    <td class="py-3 px-4 text-gray-700">
                        {{$route['description']}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <footer class="mt-12 text-center text-gray-500 py-6 border-t border-gray-200">
        &copy; {{ date('Y') }} Présence API. Généré automatiquement.
    </footer>
</div>
</body>
</html>