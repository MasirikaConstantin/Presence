<?php // Deprecated: content moved to DocsController. File kept empty to avoid autoload errors.


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
    public function index()
    {
        $apiRoutes = [];
        $webRoutes = [];

        foreach (Route::getRoutes() as $route) {
            $data = [
                'methods'    => implode('|', $route->methods()),
                'uri'        => $route->uri(),
                'name'       => $route->getName() ?: '—',
                'action'     => $route->getActionName(),
                'middleware' => implode(', ', $route->gatherMiddleware()),
                'description'=> '—',
            ];

            if (Str::startsWith($route->uri(), 'api/')) {
                $apiRoutes[] = $data;
            } else {
                $webRoutes[] = $data;
            }
        }

        // Descriptions personnalisées (complétez au besoin)
        $descriptions = [
            'api/posts' => 'Liste ou CRUD des posts',
            'api/presences' => "Enregistre la présence d'un utilisateur",
            'api/presences/verifie' => 'Vérifie la présence du jour',
            'docs' => "Documentation interactive de l'API",
        ];

        foreach ([$apiRoutes, $webRoutes] as &$group) {
            foreach ($group as &$r) {
                if (isset($descriptions[$r['uri']])) {
                    $r['description'] = $descriptions[$r['uri']];
                }
            }
        }
        unset($group, $r);

        return view('docs', compact('apiRoutes', 'webRoutes'));
    }
}


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
    public function index()
    {
        $apiRoutes = [];
        $webRoutes = [];

        foreach (Route::getRoutes() as $route) {
            $info = [
                'methods'     => implode('|', $route->methods()),
                'uri'         => $route->uri(),
                'name'        => $route->getName() ?: '—',
                'action'      => $route->getActionName(),
                'middleware'  => implode(', ', $route->gatherMiddleware()),
                'description' => '—',
            ];

            if (Str::startsWith($route->uri(), 'api/')) {
                $apiRoutes[] = $info;
            } else {
                $webRoutes[] = $info;
            }
        }

        // Descriptions personnalisées des routes
        $descriptions = [
            'api/posts' => 'Liste ou CRUD des posts',
            'api/presences' => 'Enregistre la présence d\'un utilisateur',
            'api/presences/verifie' => 'Vérifie la présence du jour',
            'docs' => 'Documentation interactive de l\'API',
        ];

        $applyDesc = function (&$routes) use ($descriptions) {
            foreach ($routes as &$r) {
                if (isset($descriptions[$r['uri']])) {
                    $r['description'] = $descriptions[$r['uri']];
                }
            }
        };
        $applyDesc($apiRoutes);
        $applyDesc($webRoutes);

        return view('docs', compact('apiRoutes', 'webRoutes'));
    }
}


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
    public function index()
    {
        $apiRoutes = [];
        $webRoutes = [];

        foreach (Route::getRoutes() as $route) {
            $entry = [
                'methods'    => implode('|', $route->methods()),
                'uri'        => $route->uri(),
                'name'       => $route->getName() ?: '—',
                'action'     => $route->getActionName(),
                'middleware' => implode(', ', $route->gatherMiddleware()),
                'description'=> '—',
            ];

            if (Str::startsWith($route->uri(), 'api/')) {
                $apiRoutes[] = $entry;
            } else {
                $webRoutes[] = $entry;
            }
        }

        // Descriptions personnalisées des routes (compléter si besoin)
        $descriptions = [
            'api/posts' => 'Liste ou CRUD des posts',
            'api/presences' => 'Enregistre la présence d\'un utilisateur',
            'api/presences/verifie' => 'Vérifie la présence du jour pour un utilisateur',
            'docs' => 'Documentation interactive de l\'API',
        ];

        $applyDesc = function (&$routes) use ($descriptions) {
            foreach ($routes as &$r) {
                if (isset($descriptions[$r['uri']])) {
                    $r['description'] = $descriptions[$r['uri']];
                }
            }
        };

        $applyDesc($apiRoutes);
        $applyDesc($webRoutes);

        return view('docs', compact('apiRoutes', 'webRoutes'));
    }
}


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DocumentationController extends Controller
{
    public function index()
    {
        // Récupère toutes les routes enregistrées par Laravel
        $routeCollection = Route::getRoutes();
        $apiRoutes = [];
        $webRoutes = [];
        foreach (Route::getRoutes() as $route) {
            $entry = [
                'methods'     => implode('|', $route->methods()),
                'uri'         => $route->uri(),
                'name'        => $route->getName() ?: '—',
                'action'      => $route->getActionName(),
                'middleware'  => implode(', ', $route->gatherMiddleware()),
            ];
            if (Str::startsWith($route->uri(), 'api/')) {
                $apiRoutes[] = $entry;
            } else {
                $webRoutes[] = $entry;
            }
        }
        // descriptions personnalisées des routes (ajoute ici selon le besoin)
        $descriptions = [
            'api/posts' => 'Liste des posts (API)',
            'api/presences' => 'Enregistre une présence',
            'api/presences/verifie' => 'Vérifie la présence du jour',
            'docs' => 'Documentation de l\'API',
            // ajoute d\'autres descriptions si nécessaire
        ];

        // Ajoute la description au tableau
        $appendDesc = function (&$arr) use ($descriptions) {
            foreach ($arr as &$r) {
                $r['description'] = $descriptions[$r['uri']] ?? '—';
            }
        };
        $appendDesc($apiRoutes);
        $appendDesc($webRoutes);

        return view('docs', compact('apiRoutes', 'webRoutes'));
            'apiRoutes' => $apiRoutes,
            'webRoutes' => $webRoutes,
        ]);
    }


            $args = $match[2];
            // Nettoyage des arguments (URL, contrôleur, etc)
            $args = preg_replace('/\s+/', ' ', $args);
            $routes[] = [
                'method' => strtoupper($method),
    
            ];
        }

}

