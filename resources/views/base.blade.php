

<DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <nav class=" w-full z-50 bg-gray-900 mb-10  mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0">
                        <a href="#" class="text-2xl font-bold text-orange-500">Logo</a>
                    </div>
        
                    <!-- Navigation desktop -->
                    <div class="hidden md:flex items-center space-x-8">
                        <div class="dropdown relative group">
                            <button class="dropdown-button flex items-center space-x-1 px-3 py-2 text-white hover:text-orange-500">
                                <span>Produits</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <!-- Container pour le dropdown -->
                            <div class="dropdown-content opacity-0 invisible group-hover:opacity-100 group-hover:visible fixed left-0 right-0 mt-2 transition-all duration-300 ease-in-out">
                                <div class="absolute w-full">
                                    <div class="max-w-6xl mx-auto bg-gray-900 rounded-lg shadow-xl p-6">
                                        <!-- Grille des cards -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                            <!-- [Cards du menu desktop restent identiques] -->
                                            <!-- Compute Card -->
                                            <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                                <h3 class="text-white text-lg font-semibold mb-2">Services Compute</h3>
                                                <p class="text-gray-400 mb-4">Lancez et gérez des serveurs virtuels en quelques minutes</p>
                                                <ul class="space-y-2">
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon EC2</a></li>
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">AWS Lambda</a></li>
                                                </ul>
                                            </div>
        
                                            <!-- Storage Card -->
                                            <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                                <h3 class="text-white text-lg font-semibold mb-2">Stockage</h3>
                                                <p class="text-gray-400 mb-4">Solutions de stockage évolutives pour vos données</p>
                                                <ul class="space-y-2">
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon S3</a></li>
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon EBS</a></li>
                                                </ul>
                                            </div>
        
                                            <!-- Database Card -->
                                            <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                                <h3 class="text-white text-lg font-semibold mb-2">Base de données</h3>
                                                <p class="text-gray-400 mb-4">Bases de données gérées pour vos applications</p>
                                                <ul class="space-y-2">
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon RDS</a></li>
                                                    <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon DynamoDB</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <a href="#" class="text-white hover:text-orange-500">Tarification</a>
                        <a href="#" class="text-white hover:text-orange-500">Documentation</a>
                    </div>
        
                    <!-- Boutons droite -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="#" class="text-white hover:text-orange-500">Se connecter</a>
                        <a href="#" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors">
                            Créer un compte
                        </a>
                    </div>
        
                    <!-- Menu mobile -->
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
        
                <!-- Menu mobile -->
                <div id="mobile-menu" class="hidden md:hidden pb-6">
                    <div class="space-y-4 px-4 pt-4">
                        <!-- Menu principal mobile -->
                        <div class="space-y-2">
                            <button id="products-menu-button" class="w-full flex justify-between items-center px-3 py-2 text-white hover:text-orange-500">
                                <span>Produits</span>
                                <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <!-- Sous-menu Produits (caché par défaut) -->
                            <div id="products-submenu" class="hidden space-y-4 pl-4">
                                <div class="space-y-2">
                                    <button class="product-category-button w-full flex justify-between items-center px-3 py-2 text-white hover:text-orange-500">
                                        <span>Services Compute</span>
                                        <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="product-category-content hidden pl-4 space-y-2">
                                        <a href="#" class="block px-3 py-2 text-orange-500">Amazon EC2</a>
                                        <a href="#" class="block px-3 py-2 text-orange-500">AWS Lambda</a>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <button class="product-category-button w-full flex justify-between items-center px-3 py-2 text-white hover:text-orange-500">
                                        <span>Stockage</span>
                                        <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="product-category-content hidden pl-4 space-y-2">
                                        <a href="#" class="block px-3 py-2 text-orange-500">Amazon S3</a>
                                        <a href="#" class="block px-3 py-2 text-orange-500">Amazon EBS</a>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <button class="product-category-button w-full flex justify-between items-center px-3 py-2 text-white hover:text-orange-500">
                                        <span>Base de données</span>
                                        <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </button>
                                    <div class="product-category-content hidden pl-4 space-y-2">
                                        <a href="#" class="block px-3 py-2 text-orange-500">Amazon RDS</a>
                                        <a href="#" class="block px-3 py-2 text-orange-500">Amazon DynamoDB</a>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="block px-3 py-2 text-white hover:text-orange-500">Tarification</a>
                            <a href="#" class="block px-3 py-2 text-white hover:text-orange-500">Documentation</a>
                        </div>
                        <div class="space-y-2">
                            <a href="#" class="block px-3 py-2 text-white hover:text-orange-500">Se connecter</a>
                            <a href="#" class="block bg-orange-500 text-white px-4 py-2 rounded-md text-center hover:bg-orange-600">
                                Créer un compte
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <main class="px-8 py-2 mt-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, libero? Rem, est corrupti dolor aut sapiente explicabo. Harum libero fugiat veniam eveniet voluptate reiciendis quaerat officia omnis, aliquam optio tempore.
            @yield('contenus')

        </main>
            
                                <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                                </footer>
    </div>
                    