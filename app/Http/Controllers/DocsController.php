<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class DocsController extends Controller
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

        $descriptions = [
            'api/posts'             => 'Liste ou CRUD des posts',
            'api/presences'         => "Enregistre la présence d'un utilisateur",
            'api/presences/verifie' => 'Vérifie la présence du jour',
            'docs'                  => "Documentation interactive de l'API",
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
