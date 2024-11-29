@section("titre", "Les Statistique")
<x-app-layout>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{
        users: {{ Js::from($data) }},
        
        init() {
            this.$nextTick(() => {
                this.initCharts();
            });
        },

        initCharts() {
            // Graphique des présences
            new Chart(document.getElementById('presenceChart'), {
                type: 'pie',
                data: {
                    labels: ['Présents', 'Absents'],
                    datasets: [{
                        data: [this.presentCount, this.absentCount],
                        backgroundColor: ['#059669', '#DC2626']
                    }]
                }
            });

            // Graphique par catégorie
            const categories = Object.entries(this.categoriesStats);
            new Chart(document.getElementById('categoryChart'), {
                type: 'bar',
                data: {
                    labels: categories.map(([cat]) => cat),
                    datasets: [{
                        label: 'Nombre d\'utilisateurs',
                        data: categories.map(([, count]) => count),
                        backgroundColor: '#3B82F6'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        },
        
        get totalUsers() {
            return this.users.length;
        },
        
        get avgDistance() {
            return (this.users.reduce((sum, user) => sum + user.distance, 0) / this.users.length / 1000).toFixed(2);
        },
        
        get presentCount() {
            return this.users.filter(user => user.statut !== 'Absent').length;
        },
        
        get absentCount() {
            return this.users.filter(user => user.statut === 'Absent').length;
        },
        
        get categoriesStats() {
            return this.users.reduce((acc, user) => {
                const categorie = user.utilisateur.categorie.nom;
                acc[categorie] = (acc[categorie] || 0) + 1;
                return acc;
            }, {});
        }
    }" class="container mx-auto px-4 py-8">
        

    <div class="bg-gray-700 p-8 rounded-lg shadow-lg mb-6">
        <form action="{{ route('presences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Recherche rapide -- >
            <div class="relative">
                <input type="search" name="search" value="{{ request('search') }}" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Recherche Rapide" />
            </div-->
    <p class="text-gray-200 font-bold text-xl" >Filtré en terme de date</p>
            <!-- Filtre par date de début -->
            <div class="relative">
                <input type="date" name="date_start" value="{{ request('date_start') }}" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Date de début" />
            </div>
    
            <!-- Filtre par date de fin -->
            <div class="relative">
                <input type="date" name="date_end" value="{{ request('date_end') }}" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Date de fin" />
            </div>
    
            <!-- Filtre par statut -->
            <!--div class="flex space-x-2">
                <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-4 focus:ring-blue-500 focus:border-blue-500 flex-grow">
                    <option value="">Tous les statuts</option>
                    <option value="Présent" {{ request('status') === 'Présent' ? 'selected' : '' }}>Présents</option>
                    <option value="Absent" {{ request('status') === 'Absent' ? 'selected' : '' }}>Absents</option>
                </select>
            </div-->
    
            <div class="md:col-span-4 flex justify-end space-x-2">
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 transition duration-150 ease-in-out">
                    Appliquer les filtres
                </button>
                <a href="{{ route('presences.index') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-6 py-3 transition duration-150 ease-in-out">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    

        <!-- En-tête avec les statistiques globales -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Total Utilisateurs</h3>
                <p class="text-3xl font-bold text-blue-600" x-text="totalUsers"></p>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Distance Moyenne (km)</h3>
                <p class="text-3xl font-bold text-green-600" x-text="avgDistance"></p>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Présents</h3>
                <p class="text-3xl font-bold text-emerald-600" x-text="presentCount"></p>
            </div>
            
            <div class="bg-white p-4 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700">Absents</h3>
                <p class="text-3xl font-bold text-red-600" x-text="absentCount"></p>
            </div>
        </div>


        <!-- Graphiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Répartition Présents/Absents</h3>
                <canvas id="presenceChart"></canvas>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Répartition par Catégorie</h3>
                <canvas id="categoryChart"></canvas>
            </div>
        </div>



          

        <!-- Tableau des utilisateurs -->
        <!--div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matricule</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Distance (km)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="user in users" :key="user.id">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap" x-text="user.utilisateur.matricule"></td>
                            <td class="px-6 py-4 whitespace-nowrap" x-text="user.utilisateur.name"></td>
                            <td class="px-6 py-4 whitespace-nowrap" x-text="user.utilisateur.categorie.nom"></td>
                            <td class="px-6 py-4 whitespace-nowrap" x-text="user.utilisateur.lieu.nom"></td>
                            <td class="px-6 py-4 whitespace-nowrap" x-text="(user.distance / 1000).toFixed(2)"></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="{
                                    'px-2 py-1 text-xs font-semibold rounded-full': true,
                                    'bg-red-100 text-red-800': user.statut === 'Absent',
                                    'bg-green-100 text-green-800': user.statut !== 'Absent'
                                }" x-text="user.statut"></span>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div-->
    </div>
</x-app-layout>