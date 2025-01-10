@section('titre','Utilisateur')
<x-app-layout>
         
    <div class="container mx-auto px-4 py-6">
        <!-- Titre -->
        <h1 class="text-3xl font-extrabold text-gray-200 mb-6">Liste des Utilisateurs</h1>
    
        <!-- Lien retour -->
        <a href="{{ route('dashboard') }}" class="inline-block mb-6 text-blue-600 hover:text-blue-800 transition">← Retour au tableau de bord</a>
    
        <!-- Barre de recherche -->
        <div class="w-full md:w-2/3 lg:w-1/2 mb-6">
            <form>
                <label for="default-search" class="sr-only">Rechercher</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="search" id="myInput" onkeyup="filterTable()" class="block w-full p-4 pl-10 text-sm text-gray-700 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Recherche Rapide" required />
                    <button type="submit" class="absolute right-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    
        @if (session('success'))
        <div class="p-4 mb-6 text-sm bg-green-100 text-green-800 rounded-lg" role="alert">
            <span class="font-medium">Astuce :</span> {{ session("success") }}
        </div>
        @endif
        <!-- Message d'alerte -->
        <div class="p-4 mb-6 text-sm bg-green-100 text-green-800 rounded-lg" role="alert">
            <span class="font-medium">Astuce :</span> Appuyez sur un utilisateur pour voir ses activités.
        </div>
    
        <!-- Tableau des utilisateurs -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table id="myTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Nom</th>
                        <th scope="col" class="px-6 py-3">Matricule</th>
                        <th scope="col" class="px-6 py-3">Lieu</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                        <th scope="" class="px-2 py-1">Image</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-700">
                        <td class="px-6 py-4 text-sm">{{ $user->id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a href="{{ route('voir', $user->id) }}" class="text-blue-600 hover:underline">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->matricule }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->lieu ? $user->lieu->nom : 'Aucun lieu' }}
                        </td>
                        <td class="px-6 py-4">
                            <button data-modal-target="deleteModal{{ $user->id }}" 
                                    data-modal-toggle="deleteModal{{ $user->id }}" 
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Supprimer
                            </button>
                
                            <a href="{{ route('users.show', ['user' => $user]) }}" 
                               class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                Modifier
                            </a>
                        </td>
                        <td class="px-6 py-4">
                           @if ($user->image)
                            <div class="flex flex-col items-center pb-1">
                                <img class="w-24 h-24 mb- rounded-full shadow-lg" src="{{ $user->profilUrl() }}" alt="{{ $user->name }}"/>
                            </div>
                            @else
                            <button>Vide</button>
                           @endif
                        </td>
                    </tr>
                
                    <!-- Modal de confirmation -->
                    <div id="deleteModal{{ $user->id }}" tabindex="-1" 
                         class="fixed inset-0 z-50 hidden p-4 overflow-y-auto bg-gray-900 bg-opacity-50">
                        <div class="relative w-full max-w-md mx-auto">
                            <div class="bg-white rounded-lg shadow-md">
                                <button type="button" 
                                        class="absolute top-3 right-3 text-gray-400 hover:text-gray-700" 
                                        data-modal-hide="deleteModal{{ $user->id }}">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                                <div class="p-6">
                                    <svg class="mx-auto mb-4 w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mb-5 text-lg text-gray-700 text-center">
                                        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
                                    </h3>
                                    <div class="flex justify-center gap-4">
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-600 text-white hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5">
                                                Oui, supprimer
                                            </button>
                                        </form>
                                        <button data-modal-hide="deleteModal{{ $user->id }}" 
                                                class="bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Non, annuler
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    
        <!-- Retour -->
        <a href="{{ route('dashboard') }}" class="inline-block mt-6 text-blue-600 hover:text-blue-800 transition">← Retour au tableau de bord</a>
    </div>
    
        <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const deleteButtons = document.querySelectorAll('[data-modal-toggle]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-target');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.remove('hidden');
                    }
                });
            });
    
            const cancelButtons = document.querySelectorAll('[data-modal-hide]');
            cancelButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const modalId = button.getAttribute('data-modal-hide');
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('hidden');
                    }
                });
            });
        });
        </script>
    
   
     <script>
                    
                    // Sélectionnez tous les éléments du tableau
            var elements = document.querySelectorAll("table #tr");
            
            // Parcourez tous les éléments
            for(var i = 0; i < elements.length; i++) {
                // Si l'élément est supérieur à 3, cachez-le
                if(i >= 15) {
                    elements[i].style.display = "none";
                }
            }
            
            // Sélectionnez tous les éléments du tableau
            var elements = document.querySelectorAll("table #trs");
            
            // Parcourez tous les éléments
            for(var i = 0; i < elements.length; i++) {
                // Si l'élément est supérieur à 3, cachez-le
                if(i >= 50) {
                    elements[i].style.display = "none";
                }
            }
            
            function filterTable() {
            
                // Declare variables
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");
            
                // Loop through all table rows, and hide those who don't match the search query
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[1];
            
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            
            }
            
            </script>
   
</x-app-layout>


