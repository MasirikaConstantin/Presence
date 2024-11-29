@section("titre", "Les Présences")
<x-app-layout>
    @php
        $k = 0;
    @endphp
   <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-8 flex flex-col">



        <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
            <div class="mb-8 space-y-4">
                <form action="{{ route('presences.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Recherche rapide -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="search" name="search" value="{{ request('search') }}" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Recherche Rapide" />
                    </div>
        
                    <!-- Filtre par date -->
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <input type="date" name="date" value="{{ request('date') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-4">
                    </div>
        
                    <!-- Filtre par statut -->
                    <div class="flex space-x-2">
                        <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-4 focus:ring-blue-500 focus:border-blue-500 flex-grow">
                            <option value="">Tous les statuts</option>
                            <option value="Présent" {{ request('status') === 'Présent' ? 'selected' : '' }}>Présents</option>
                            <option value="Absent" {{ request('status') === 'Absent' ? 'selected' : '' }}>Absents</option>
                        </select>
                    </div>
        
                    <div class="md:col-span-3 flex justify-end space-x-2">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-3 transition duration-150 ease-in-out">
                            Appliquer les filtres
                        </button>
        
                        <a href="{{ route('presences.index') }}" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-6 py-3 transition duration-150 ease-in-out">
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8 bg-gray-700">
            <div class="inline-block min-w-full py-2 align-middle">
                <div class="overflow-hidden shadow ring-1 ring-black bg-gray-700 ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300 bg-gray-700">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Matricule</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nom</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Lieu</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date/Heure</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Type</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Distance</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach ($presences as $presence)
                            <tr>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ $presence->utilisateur->matricule }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ $presence->utilisateur->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ $presence->utilisateur->lieu->nom }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ $presence->date }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ $presence->type == 1 ? 'Arrivée' : 'Départ' }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    {{ number_format($presence->distance, 2) }} m
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                        {{ $presence->statut === 'Absent' ? 'bg-red-100 text-red-800' : 
                                           ($presence->statut === 'Présent et à l\'heure' ? 'bg-green-100 text-green-800' : 
                                           'bg-yellow-100 text-yellow-800') }}">
                                        {{ $presence->statut }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
    <div class="mt-4 px-6">
        {{ $presences->links() }}
    </div>
        </div>
    </div>
</div>
</x-app-layout>
