<x-app-layout>
@php
    $k=0;
@endphp
<div class="container mx-auto p-6">
    <h1 class="text-2xl text-gray-200 font-bold mb-6">Gestion des Lieux</h1>
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Formulaire d'ajout de lieu -->
    <form action="{{ route('lieux.store') }}" method="POST" class="mb-8 bg-gray-700 shadow-md rounded px-8 pt-6 pb-8 mb-4 py-6">
        @csrf
        <input type="hidden" name="action" value="add">
        <div class="mb-4">
            <label class="block text-gray-200 text-sm font-bold mb-2" for="nom">
                Nom du lieu
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="nom" type="text" name="nom" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-200 text-sm font-bold mb-2" for="latitude">
                Latitude
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="latitude" type="text" name="latitude" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-200 text-sm font-bold mb-2" for="longitude">
                Longitude
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="longitude" type="text" name="longitude" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Ajouter un lieu
            </button>
        </div>
    </form>

    <!-- Liste des lieux -->
    <a href="{{ route('dashboard') }}" class="mb-4 inline-block bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Retour au tableau de bord
    </a>
    <h2 class="text-xl font-bold mb-4 text-gray-200 ">Liste des lieux</h2>
    <table class="w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr>
                <th class="text-left p-3 px-5">Nom</th>
                <th class="text-left p-3 px-5">Latitude</th>
                <th class="text-left p-3 px-5">Longitude</th>
                <th class="text-left p-3 px-5">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lieux as $lieu)
            @php
                $k++;
            @endphp
            <tr>
                <td class="p-3 px-5">{{ $lieu->nom }}</td>
                <td class="p-3 px-5">{{ $lieu->latitude }}</td>
                <td class="p-3 px-5">{{ $lieu->longitude }}</td>
                <td class="p-3 px-5">
                    <button data-modal-target="static-modal{{ $k }}" data-modal-toggle="static-modal{{ $k }}" type="button"
                            class="text-blue-500 hover:text-blue-700 mr-2">Modifier</button>
                    <form action="{{ route('lieux.destroy', $lieu) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lieu ?');">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>



  <!-- Main modal -->
  <div id="static-modal{{ $k }}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full  md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-2xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Static modal
                  </h3>
                  <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal{{ $k }}">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
              <div class="p-4 md:p-5 space-y-4">
                <form id="editForm" action="{{ route('lieux.update',['lieu'=>$lieu]) }}" method="POST" class="mt-2 text-left">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_nom">
                            Nom du lieu
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                               id="edit_nom" type="text" name="nom" value="{{ $lieu->nom }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_latitude">
                            Latitude
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                               id="edit_latitude" type="text" name="latitude" value="{{ $lieu->latitude }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-200 text-sm font-bold mb-2" for="edit_longitude">
                            Longitude
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                               id="edit_longitude" type="text" name="longitude" value="{{ $lieu->longitude }}" required>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Enregistrer
                        </button>
                        <button type="button" data-modal-hide="static-modal{{ $k }}"     class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Annuler
                        </button>
                    </div>
                </form>
              </div>
              
          </div>
      </div>
  </div>

  

            @endforeach
        </tbody>
    </table>


   
</div>

</x-app-layout>