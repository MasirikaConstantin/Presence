<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

                    <body
    class="bg-cover"
    style="
      background-image: url('https://images.unsplash.com/photo-1633078654544-61b3455b9161?q=80&w=2845&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    ">
    <section class="grid w-screen h-screen bg-black/50">
      <div class="m-auto">
        <div class="space-y-6">
          <h1
            class="block font-black text-center text-gray-50 text-7xl sm:text-9xl">
            404
          </h1>
          <p class="max-w-xl px-4 text-center text-gray-50">
            On dirait que vous êtes perdus. 
           Contactez l'administrateur pour acceder à votre compte.
          </p>
          <div class="flex items-center justify-center gap-4">
            <button class="px-4 py-3 bg-gray-300 rounded-md">
              Signalez un probleme
            </button>
            <a href="/#" class="flex items-center gap-2 text-gray-300">
              <span class="inline-block w-4 h-4">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-full h-full fill-current"
                  viewBox="0 0 512 512">
                  <path
                    d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 288 480 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-370.7 0 73.4-73.4c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-128 128z" />
                </svg>
              </span>
              <span>retour</span>


              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            </a>
          </div>
        </div>
      </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
  </body>
                    </html>