<x-app-layout>
    <div class="container mx-auto p-6">
           <h1 class="text-2xl text-gray-200 font-bold mb-6">Créer un Utilisateur</h1>
           
           @if(session('success'))
               <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                   <span class="block sm:inline">{{ session('success') }}</span>
                   
               </div>
           @endif
       
           <form method="POST"  action="{{ route($user->exists ? 'users.update' : 'users.store', $user) }}" class="bg-gray-700 shadow-md rounded px-8 pt-6 pb-8 mb-4">
               @csrf
               @if($user->exists)
               @method('PUT') <!-- Indique que cette requête est une mise à jour -->
           @endif
               <div class="mb-4">
                   <label class="block text-gray-200 text-sm font-bold mb-2" for="nom">
                       Nom :
                   </label>
                   <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                          type="text" 
                          id="nom" 
                          name="name" 
                          value="{{ old('name',$user->name) }}"
                          required>
                          @error("name")
                       <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                   @enderror
               </div>

               <div class="mb-4">
                <label class="block text-gray-200 text-sm font-bold mb-2" for="nom">
                    E- mail :
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                       type="email" 
                       id="email" 
                       name="email" 
                       value="{{ old('email',$user->email) }}"
                       required>
                       <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                        <span>En cas de email inexistant n'oubliez pas de créer un</span>
                       </div>

                       @error("email")
                       <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                   @enderror                       
                       
            </div>
       
            
               <div class="mb-4">
                   <label class="block text-gray-200 text-sm font-bold mb-2" for="lieu_id">
                       Lieu :
                   </label>
                   <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
        id="lieu_id" 
        name="lieu_id" 
        required>
    <option value="">Sélectionnez un lieu</option>
    @foreach($lieux as $lieu)
        <option value="{{ $lieu->id }}"
            @if(old('lieu_id') == $lieu->id || (isset($user) && $user->lieux->contains($lieu->id)))
                selected
            @endif>
            {{ $lieu->nom }}
        </option>
    @endforeach
</select>

                   @error("lieu_id")
                       <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                   @enderror
               </div>
       
               <div class="mb-4">
                   <label class="block text-gray-200 text-sm font-bold mb-2" for="password">
                       Mot de passe :
                   </label>
                   <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                          type="password" 
                          id="password" 
                          name="password" 
                          >
                          @error("password")
                       <p class="mt-2 text-red-500 text-sm">{{ $message }}</p>
                   @enderror
               </div>
       
               <div class="flex items-center justify-between">
                   <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                           type="submit">
                        {{ $user->exists ? 'Modifier l\'utilisateur' : 'Créer l\'utilisateur' }}
                   </button>
                  
               </div>
           </form>
           
           <a href="{{ route('dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
               Retour au tableau de bord
           </a>
       </div>
   
   </x-app-layout>
   