<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

          <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <script src="https://cdn.tailwindcss.com"></script>

    @endif
      
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" alt="Laravel background" />
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <svg class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M61.8548 14.6253C61.8778 14.7102 61.8895 14.7978 61.8897 14.8858V28.5615C61.8898 28.737 61.8434 28.9095 61.7554 29.0614C61.6675 29.2132 61.5409 29.3392 61.3887 29.4265L49.9104 36.0351V49.1337C49.9104 49.4902 49.7209 49.8192 49.4118 49.9987L25.4519 63.7916C25.3971 63.8227 25.3372 63.8427 25.2774 63.8639C25.255 63.8714 25.2338 63.8851 25.2101 63.8913C25.0426 63.9354 24.8666 63.9354 24.6991 63.8913C24.6716 63.8838 24.6467 63.8689 24.6205 63.8589C24.5657 63.8389 24.5084 63.8215 24.456 63.7916L0.501061 49.9987C0.348882 49.9113 0.222437 49.7853 0.134469 49.6334C0.0465019 49.4816 0.000120578 49.3092 0 49.1337L0 8.10652C0 8.01678 0.0124642 7.92953 0.0348998 7.84477C0.0423783 7.8161 0.0598282 7.78993 0.0697995 7.76126C0.0884958 7.70891 0.105946 7.65531 0.133367 7.6067C0.152063 7.5743 0.179485 7.54812 0.20192 7.51821C0.230588 7.47832 0.256763 7.43719 0.290416 7.40229C0.319084 7.37362 0.356476 7.35243 0.388883 7.32751C0.425029 7.29759 0.457436 7.26518 0.498568 7.2415L12.4779 0.345059C12.6296 0.257786 12.8015 0.211853 12.9765 0.211853C13.1515 0.211853 13.3234 0.257786 13.475 0.345059L25.4531 7.2415H25.4556C25.4955 7.26643 25.5292 7.29759 25.5653 7.32626C25.5977 7.35119 25.6339 7.37362 25.6625 7.40104C25.6974 7.43719 25.7224 7.47832 25.7523 7.51821C25.7735 7.54812 25.8021 7.5743 25.8196 7.6067C25.8483 7.65656 25.8645 7.70891 25.8844 7.76126C25.8944 7.78993 25.9118 7.8161 25.9193 7.84602C25.9423 7.93096 25.954 8.01853 25.9542 8.10652V33.7317L35.9355 27.9844V14.8846C35.9355 14.7973 35.948 14.7088 35.9704 14.6253C35.9792 14.5954 35.9954 14.5692 36.0053 14.5405C36.0253 14.4882 36.0427 14.4346 36.0702 14.386C36.0888 14.3536 36.1163 14.3274 36.1375 14.2975C36.1674 14.2576 36.1923 14.2165 36.2272 14.1816C36.2559 14.1529 36.292 14.1317 36.3244 14.1068C36.3618 14.0769 36.3942 14.0445 36.4341 14.0208L48.4147 7.12434C48.5663 7.03694 48.7383 6.99094 48.9133 6.99094C49.0883 6.99094 49.2602 7.03694 49.4118 7.12434L61.3899 14.0208C61.4323 14.0457 61.4647 14.0769 61.5021 14.1055C61.5333 14.1305 61.5694 14.1529 61.5981 14.1803C61.633 14.2165 61.6579 14.2576 61.6878 14.2975C61.7103 14.3274 61.7377 14.3536 61.7551 14.386C61.7838 14.4346 61.8 14.4882 61.8199 14.5405C61.8312 14.5692 61.8474 14.5954 61.8548 14.6253ZM59.893 27.9844V16.6121L55.7013 19.0252L49.9104 22.3593V33.7317L59.8942 27.9844H59.893ZM47.9149 48.5566V37.1768L42.2187 40.4299L25.953 49.7133V61.2003L47.9149 48.5566ZM1.99677 9.83281V48.5566L23.9562 61.199V49.7145L12.4841 43.2219L12.4804 43.2194L12.4754 43.2169C12.4368 43.1945 12.4044 43.1621 12.3682 43.1347C12.3371 43.1097 12.3009 43.0898 12.2735 43.0624L12.271 43.0586C12.2386 43.0275 12.2162 42.9888 12.1887 42.9539C12.1638 42.9203 12.1339 42.8916 12.114 42.8567L12.1127 42.853C12.0903 42.8156 12.0766 42.7707 12.0604 42.7283C12.0442 42.6909 12.023 42.656 12.013 42.6161C12.0005 42.5688 11.998 42.5177 11.9931 42.4691C11.9881 42.4317 11.9781 42.3943 11.9781 42.3569V15.5801L6.18848 12.2446L1.99677 9.83281ZM12.9777 2.36177L2.99764 8.10652L12.9752 13.8513L22.9541 8.10527L12.9752 2.36177H12.9777ZM18.1678 38.2138L23.9574 34.8809V9.83281L19.7657 12.2459L13.9749 15.5801V40.6281L18.1678 38.2138ZM48.9133 9.14105L38.9344 14.8858L48.9133 20.6305L58.8909 14.8846L48.9133 9.14105ZM47.9149 22.3593L42.124 19.0252L37.9323 16.6121V27.9844L43.7219 31.3174L47.9149 33.7317V22.3593ZM24.9533 47.987L39.59 39.631L46.9065 35.4555L36.9352 29.7145L25.4544 36.3242L14.9907 42.3482L24.9533 47.987Z" fill="currentColor"/></svg>
                        </div>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <main class="mt-6">
                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                            <a href="{{ route('posts') }}">POSTS</a>
                            <a
                                href="https://laravel.com/docs"
                                id="docs-card"
                                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                    <img
                                        src="https://laravel.com/assets/img/welcome/docs-light.svg"
                                        alt="Laravel documentation screenshot"
                                        class="aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)] dark:hidden"
                                        onerror="
                                            document.getElementById('screenshot-container').classList.add('!hidden');
                                            document.getElementById('docs-card').classList.add('!row-span-1');
                                            document.getElementById('docs-card-content').classList.add('!flex-row');
                                            document.getElementById('background').classList.add('!hidden');
                                        "
                                    />
                                    <img
                                        src="https://laravel.com/assets/img/welcome/docs-dark.svg"
                                        alt="Laravel documentation screenshot"
                                        class="hidden aspect-video h-full w-full flex-1 rounded-[10px] object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] dark:block"
                                    />
                                    <div
                                        class="absolute -bottom-16 -left-16 h-40 w-[calc(100%+8rem)] bg-gradient-to-b from-transparent via-white to-white dark:via-zinc-900 dark:to-zinc-900"
                                    ></div>
                                </div>

                                <div class="relative flex items-center gap-6 lg:items-end">
                                    <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path fill="#FF2D20" d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z"/><path fill="#FF2D20" d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z"/></svg>
                                        </div>

                                        <div class="pt-3 sm:pt-5 lg:pt-0">
                                            <h2 class="text-xl font-semibold text-black dark:text-white">Documentation</h2>

                                            <p class="mt-4 text-sm/relaxed">
                                                Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                                            </p>
                                        </div>
                                    </div>

                                    <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                </div>
                            </a>

                            <a
                                href="https://laracasts.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laracasts</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <a
                                href="https://laravel-news.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                            >
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/><path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laravel News</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <g fill="#FF2D20">
                                            <path
                                                d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"
                                            />
                                        </g>
                                    </svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Vibrant Ecosystem</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a>, and <a href="https://herd.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Herd</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, and more.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>


<!--DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
</head>
<body>
    <nav class="fixed w-full z-50 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                < !-- Logo -- >
                <div class="flex-shrink-0">
                    <a href="#" class="text-2xl font-bold text-orange-500">Logo</a>
                </div>
    
                < !-- Navigation desktop -- >
                <div class="hidden md:flex items-center space-x-8">
                    <div class="dropdown relative group">
                        <button class="dropdown-button flex items-center space-x-1 px-3 py-2 text-white hover:text-orange-500">
                            <span>Produits</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <!-- Container pour le dropdown -- >
                        <div class="dropdown-content opacity-0 invisible group-hover:opacity-100 group-hover:visible fixed left-0 right-0 mt-2 transition-all duration-300 ease-in-out">
                            <div class="absolute w-full">
                                <div class="max-w-6xl mx-auto bg-gray-900 rounded-lg shadow-xl p-6">
                                    <!-- Grille des cards -- >
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        <!-- [Cards du menu desktop restent identiques] -- >
                                        <!-- Compute Card -- >
                                        <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                            <h3 class="text-white text-lg font-semibold mb-2">Services Compute</h3>
                                            <p class="text-gray-400 mb-4">Lancez et gérez des serveurs virtuels en quelques minutes</p>
                                            <ul class="space-y-2">
                                                <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon EC2</a></li>
                                                <li><a href="#" class="text-orange-500 hover:text-orange-400">AWS Lambda</a></li>
                                            </ul>
                                        </div>
    
                                        <!-- Storage Card -- >
                                        <div class="bg-gray-800 p-4 rounded-lg hover:bg-gray-700 transition-colors">
                                            <h3 class="text-white text-lg font-semibold mb-2">Stockage</h3>
                                            <p class="text-gray-400 mb-4">Solutions de stockage évolutives pour vos données</p>
                                            <ul class="space-y-2">
                                                <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon S3</a></li>
                                                <li><a href="#" class="text-orange-500 hover:text-orange-400">Amazon EBS</a></li>
                                            </ul>
                                        </div>
    
                                        <!-- Database Card -- >
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
    
                <!-- Boutons droite -- >
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="text-white hover:text-orange-500">Se connecter</a>
                    <a href="#" class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition-colors">
                        Créer un compte
                    </a>
                </div>
    
                <!-- Menu mobile -- >
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-16 6h16"/>
                        </svg>
                    </button>
                </div>
            </div>
    
            <!-- Menu mobile -- >
            <div id="mobile-menu" class="hidden md:hidden pb-6">
                <div class="space-y-4 px-4 pt-4">
                    <!-- Menu principal mobile -- >
                    <div class="space-y-2">
                        <button id="products-menu-button" class="w-full flex justify-between items-center px-3 py-2 text-white hover:text-orange-500">
                            <span>Produits</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <!-- Sous-menu Produits (caché par défaut) -- >
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
    
    <style>
        /* Styles précédents maintenus */
        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            height: 20px;
        }
    
        @media (max-width: 1024px) {
            .dropdown-content .max-w-6xl {
                margin: 0 1rem;
            }
        }
    
        /* Nouveau style pour la rotation des flèches */
        .rotate-180 {
            transform: rotate(180deg);
        }
    </style>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion du menu mobile principal
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
    
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    
        // Gestion du menu Produits
        const productsMenuButton = document.getElementById('products-menu-button');
        const productsSubmenu = document.getElementById('products-submenu');
    
        productsMenuButton.addEventListener('click', function() {
            productsSubmenu.classList.toggle('hidden');
            productsMenuButton.querySelector('svg').classList.toggle('rotate-180');
        });
    
        // Gestion des sous-catégories de produits
        const categoryButtons = document.querySelectorAll('.product-category-button');
        
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const arrow = this.querySelector('svg');
                
                // Ferme les autres sous-menus
                document.querySelectorAll('.product-category-content').forEach(item => {
                    if (item !== content && !item.classList.contains('hidden')) {
                        item.classList.add('hidden');
                        item.previousElementSibling.querySelector('svg').classList.remove('rotate-180');
                    }
                });
    
                content.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });
    
        // Fermeture du menu mobile lors du clic sur un lien final
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    });
    </script>


<section>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse sit quos numquam repudiandae fugit harum, unde et sed accusamus architecto iusto autem ullam vel doloribus inventore maxime sunt blanditiis consequatur.
    Corporis, aliquam. Similique perspiciatis ducimus eligendi aut eos ratione sint, nulla nobis, quas asperiores velit dignissimos omnis corrupti aperiam. Animi atque maxime fugiat ullam placeat veritatis velit vitae, autem quod.
    Magnam quam eligendi, et corporis minus accusantium recusandae error similique possimus fuga quod. Omnis tempora dolore expedita pariatur neque veritatis reprehenderit iste distinctio, dolor aliquam, ab dolores, repudiandae quam aliquid?
    Perspiciatis voluptas exercitationem deleniti nam omnis harum itaque aperiam iure modi fuga qui possimus ipsam nesciunt optio vitae eum numquam quidem impedit laborum, at, ducimus nostrum dolorem. Dolorum, laborum enim?
    Expedita totam omnis facilis odio suscipit. Blanditiis error harum, quis iste nobis praesentium nulla nostrum maxime id atque sint! Magnam aliquam fugit laudantium autem numquam ut deserunt exercitationem aperiam doloremque?
    Modi eos recusandae, adipisci ipsa nesciunt suscipit cumque neque explicabo culpa soluta fuga, accusamus labore necessitatibus officia molestias animi iste voluptas. Doloribus, repellat aspernatur ex quod in obcaecati consequuntur veniam.
    Quibusdam saepe suscipit accusamus soluta veniam iure? Neque, iste! Quis, cum voluptas dignissimos sint, nostrum, odio omnis nulla libero consequatur voluptatibus molestiae alias laboriosam harum at porro. Fugit, ratione amet.
    Placeat eveniet vero eius similique, ratione accusamus aliquid est beatae ipsam officia officiis reprehenderit illo dignissimos. Nisi perspiciatis ipsam labore reprehenderit eum quae corporis autem minima, soluta earum reiciendis neque!
    Ab excepturi eos vero ratione modi officia debitis dignissimos laborum libero distinctio, repellat exercitationem similique rem quaerat a ipsum voluptatibus nostrum possimus repellendus illo mollitia? Voluptates sapiente asperiores veritatis ut!
    Nisi voluptatum labore accusamus mollitia ex esse debitis iure ratione. Ea omnis praesentium totam dolorem commodi veniam. Sed consequuntur iste nihil suscipit optio, eius accusamus enim, esse, sint dolore expedita.
    Nulla, ab eaque veniam hic, dolorum architecto mollitia sequi fugiat voluptatum facilis adipisci, quo ratione ut dolor consectetur tempora. Accusantium expedita quisquam sapiente cum illum neque ratione ullam mollitia sint.
    Accusamus molestiae atque nulla vero aperiam maxime vel quidem eum aliquam tempore dolore fugiat harum similique odio ratione error eos, iusto praesentium quo odit! Ipsam esse numquam beatae quos accusamus.
    Vel, nulla ipsa debitis nostrum obcaecati dignissimos ex, unde fuga minima magni mollitia rerum hic tempore temporibus assumenda perspiciatis autem praesentium nam cum, recusandae commodi fugiat! Assumenda iusto delectus reprehenderit.
    Saepe ratione, nulla quam eaque eveniet error amet quia ex debitis molestiae reprehenderit voluptatibus iste qui earum dignissimos laborum vel suscipit incidunt quos repellat. Pariatur qui distinctio in illum at?
    Doloribus non minima dignissimos atque aperiam neque nobis deserunt adipisci ducimus debitis obcaecati temporibus delectus pariatur illum reprehenderit quas, cupiditate doloremque incidunt enim? Sit molestiae asperiores doloribus voluptates deleniti ex.
    Doloremque itaque qui adipisci odio repellendus est consequatur commodi officia distinctio, totam dolor quasi, sed blanditiis fuga ad praesentium aspernatur placeat cum facilis ipsam veniam iusto numquam optio quisquam. Amet.
    Sunt, deserunt officiis! Autem iusto recusandae porro, obcaecati vitae eum deserunt consectetur dolorem libero esse tenetur, eius quidem? Iusto soluta sunt beatae repudiandae doloribus velit accusamus aspernatur voluptatibus tempora facere!
    Officiis suscipit adipisci molestias fugit dignissimos dolores perspiciatis officia in, distinctio aliquam autem, sed voluptatem minus quidem eveniet, omnis consectetur voluptate modi alias earum atque? Praesentium ipsam soluta quidem atque.
    Rem exercitationem aspernatur est laborum inventore facilis sint, soluta eaque molestiae officia eos nisi doloremque voluptatibus reprehenderit perferendis natus. Architecto deserunt dignissimos in repudiandae sunt, magnam at. Facere, in quae!
    Doloribus odit nam aliquam, suscipit labore vel adipisci eius dolore. Necessitatibus quos atque ab qui voluptates vel! Ab et hic sunt voluptate, necessitatibus commodi, suscipit consectetur natus impedit, itaque aspernatur!
    Enim asperiores vitae quidem culpa voluptatem iusto adipisci, libero dignissimos quisquam nulla, quas pariatur in expedita id numquam soluta, ad doloribus sapiente laborum nihil. Nemo nesciunt ipsum praesentium voluptate facere!
    Molestiae excepturi nesciunt quasi ducimus ex tenetur rerum mollitia accusamus nemo repudiandae! Cum ex enim est nostrum quos rem. Quam, adipisci. Vitae, distinctio! Quam quaerat nulla eum repudiandae assumenda sed.
    Laboriosam qui reiciendis, blanditiis odit soluta ipsum deleniti reprehenderit? Perferendis atque beatae facere aperiam tempora impedit. Magni minus ea est, ab magnam ducimus ipsam provident voluptas adipisci, placeat veritatis error?
    Quod doloribus officia similique autem eum qui quas, blanditiis neque! Et porro quidem rem aperiam vero ipsa quas veniam quia perferendis? Officiis enim nobis repellendus inventore dicta rem rerum facere!
    Porro consequatur, corrupti possimus laborum commodi debitis, quod accusamus nisi nesciunt perferendis iste? Molestiae, animi facere voluptas, at placeat incidunt consequuntur pariatur possimus reprehenderit ad totam iure earum obcaecati molestias?
    Aliquam sapiente, non repudiandae eveniet harum provident illo enim minus pariatur quidem dolore dolor sed asperiores cumque exercitationem! Perferendis quisquam optio quibusdam atque error repudiandae vel ut sunt non dolores.
    Aperiam illum enim, voluptates ab rem non, porro velit iure tempora minus debitis aspernatur, harum dolorem aliquid sapiente ipsam! Dolores nulla libero, commodi rerum iste reprehenderit beatae? Deserunt, optio quia.
    Quod nisi similique, dignissimos aliquid ad nulla hic unde suscipit, ducimus fugit animi eligendi libero. Molestias, laborum nesciunt eveniet blanditiis laboriosam non sequi error iste iusto ipsa suscipit voluptate recusandae!
    Corporis, omnis odio ipsum neque consequuntur dolorem veritatis labore pariatur rerum amet eos corrupti quis? Distinctio explicabo cupiditate voluptates, quisquam, id eveniet voluptas ea iure ipsam, excepturi dignissimos soluta mollitia.
    Laudantium officia cum blanditiis harum dicta quo iste pariatur error ea ratione. Nobis error itaque suscipit blanditiis commodi veniam quod tenetur amet adipisci tempore. Incidunt quaerat possimus recusandae tenetur aperiam?
    Expedita iure, facilis et commodi architecto aut illum corrupti debitis quia doloribus? Voluptates dolore impedit consequatur cum saepe quis, odio, atque minima iste iure nihil aliquid quibusdam modi adipisci magni.
    Aperiam molestias numquam incidunt deserunt, dolor sit vero cupiditate animi nesciunt placeat voluptas fugiat, nobis rerum aliquid quaerat exercitationem enim atque tempore eveniet? Incidunt odit laboriosam accusamus voluptatibus neque impedit?
    Totam perspiciatis esse est dolore dignissimos labore aliquam saepe neque nam, aut animi illum cupiditate quae sequi eaque ab voluptatum facilis? Quod totam corrupti sit, at commodi minus quis placeat.
    Similique quia ratione placeat quo, sit sapiente. Tempora recusandae quasi, iure saepe temporibus totam, tenetur assumenda, quis quisquam illo distinctio rerum! Impedit cupiditate consequatur odio dolores incidunt, quisquam illum et.
    Architecto facere expedita laboriosam doloremque a molestias rerum harum voluptatum? Tenetur deserunt recusandae minus eos nisi autem ex iste dicta, molestias labore reprehenderit sint provident iusto animi ut quidem itaque.
    Iure, adipisci quae minima nemo similique expedita fugiat nisi, consequuntur voluptate, repellendus delectus voluptatibus at reprehenderit suscipit voluptates provident! Expedita placeat facere et reprehenderit blanditiis consequuntur esse beatae optio nam.
    Consequatur autem laboriosam odio quia sit officia expedita fuga unde dolor optio nemo, molestias quas consectetur nostrum adipisci voluptas mollitia doloribus aliquid facilis repudiandae illo quis architecto impedit saepe! Accusantium!
    Officia totam optio, voluptatum ipsum perspiciatis aspernatur itaque magni nostrum molestiae nihil neque cupiditate laborum rem delectus dolore voluptas consectetur quo nesciunt necessitatibus sequi, impedit voluptatibus reprehenderit accusantium iusto. Asperiores?
    Est pariatur voluptatibus consequuntur ex blanditiis consequatur modi laborum iure deleniti, numquam neque vitae eaque voluptate? Quaerat assumenda modi beatae! Perferendis nulla porro ducimus sapiente libero doloremque molestiae vero ipsa!
    Eum eligendi minus aliquid sapiente natus dolores quod. Incidunt quidem cumque iste, quam deserunt vitae quas accusamus ea error enim, possimus modi architecto nulla ipsum assumenda delectus explicabo repellendus odio?
    Corporis cupiditate aliquam esse repellendus neque fuga ad natus adipisci, veniam earum eaque beatae qui velit sint, dignissimos excepturi, pariatur optio. Recusandae, eum velit deleniti magnam quam consectetur odio nam!
    Soluta quo deleniti excepturi? Voluptatum odio adipisci eveniet natus beatae dolore facere iusto veniam eligendi magnam dignissimos fuga, officia, ab asperiores ut dolores exercitationem repellat dolor! Vel assumenda culpa unde.
    Recusandae nam modi sunt voluptatibus provident corporis, harum veritatis. Deleniti, placeat enim. Sint est possimus iure quas, repellat velit enim, eveniet tempore maxime iste aliquid quibusdam provident accusamus quidem dignissimos?
    Laborum voluptatem natus enim alias temporibus perspiciatis nostrum magnam facere culpa, exercitationem quos asperiores vitae porro consequatur mollitia minima deleniti, molestias laudantium minus accusamus. Blanditiis cum aut tempora corporis quasi.
    Expedita, voluptatem voluptatibus voluptas aperiam impedit enim repellendus consequatur nisi asperiores placeat, minima facere tenetur ullam commodi est doloribus fuga! Totam qui eveniet, a reprehenderit dicta consectetur blanditiis dolore assumenda?
    Quaerat odit officia libero dicta cum. Sed magni ea illum aliquid. Consectetur nostrum magni vel saepe sapiente. Amet atque pariatur rerum tempore dolorem tenetur odit! Itaque sed ab dignissimos atque.
    Praesentium optio aliquam repellat beatae odio excepturi tenetur distinctio iste minima! Magnam, eligendi sapiente? Quae, eos. Dolor nemo debitis officiis dolorem molestias voluptatum dolore, amet illum vitae repellat, eligendi minus.
    Eaque molestias, deserunt dolore a cupiditate sunt? Sapiente vero saepe quas eos molestiae, cupiditate quaerat non! Corrupti qui officiis sunt. Delectus libero recusandae et alias hic in sit, nihil culpa!
    Impedit rem accusantium iure harum eveniet quibusdam sint. Mollitia hic quod, accusantium quae, corporis adipisci modi, reiciendis iusto quam ut nihil odit error. Possimus, eum! Iste et porro impedit expedita.
    Excepturi reiciendis hic rem, pariatur voluptas quaerat quod provident est ipsa sapiente eligendi deserunt ducimus quia consectetur? Perferendis facilis earum cumque labore sit dicta, numquam perspiciatis. Modi eligendi corporis magnam.
    Ipsa expedita quibusdam, error eveniet beatae in unde sit labore itaque modi minus numquam velit eligendi soluta reiciendis corporis suscipit sapiente, nesciunt fugiat fuga libero possimus dicta natus dignissimos? Aut?
    Soluta molestiae debitis necessitatibus accusantium nisi. Ducimus sunt iusto ipsum! Fugiat est iure nesciunt cumque, itaque fugit sint minima. Velit deleniti eius eligendi exercitationem nobis placeat, ratione quo voluptatem blanditiis.
    Quibusdam corrupti alias, reprehenderit dolorum harum veniam aliquid fugit eius eveniet molestiae tempore enim, vero nostrum laborum sequi. Aut nulla, repudiandae earum perferendis dignissimos eos ex temporibus ratione officia perspiciatis.
    Suscipit, amet itaque? Error neque aut et inventore beatae recusandae, quidem quia magnam, reiciendis eaque velit! Aspernatur quod repellat dolorem, iste et cum voluptatibus, enim eos assumenda corrupti laborum voluptate.
    In assumenda libero rerum voluptas sint eligendi minus, cum reprehenderit, nemo voluptates quae odit! Voluptatum ipsum quo tempora tenetur vero enim, nostrum laboriosam quibusdam, blanditiis dolorem ratione maxime, quod nesciunt!
    Voluptas magnam ratione aperiam aspernatur animi deserunt laboriosam unde, sint, non voluptatibus dolores soluta sunt voluptate. Corporis a veniam, voluptates, molestias quaerat obcaecati, aliquid sint esse architecto officia magnam expedita.
    Deleniti, quo cupiditate quia voluptatibus dolores alias voluptatum enim, qui iure incidunt optio. Ut iusto in laboriosam labore fugiat magni consectetur molestiae? Illo adipisci voluptate incidunt similique quia labore quas?
    Excepturi, nisi accusamus ut voluptates inventore enim fugit modi quia beatae, et consequuntur eum. Ab unde velit quo nobis fugiat, laboriosam, error explicabo autem numquam nostrum vitae, repellat tenetur quam!
    Exercitationem, dignissimos reprehenderit delectus modi vel, aut expedita eligendi incidunt numquam soluta minima autem voluptatum, ullam maiores facere doloremque repudiandae repellat esse commodi fugit culpa earum! Qui accusamus voluptate ab.
    Iure, unde quam quo quos ipsam fugiat soluta praesentium error vitae corporis quaerat necessitatibus quidem facilis eligendi voluptas, nesciunt aspernatur esse vel, incidunt aliquam quia et quibusdam dolore. Quibusdam, consequatur.
    Ex cum vel nulla dicta facere nostrum asperiores neque laboriosam molestias. Iusto nisi temporibus vitae nesciunt molestias et repudiandae. Voluptatum in vel maiores adipisci magnam error sapiente nisi, eius aperiam?
    Aperiam iusto nemo exercitationem dolorum! Voluptatem rem dicta excepturi suscipit perspiciatis mollitia facilis ducimus magnam! Voluptate incidunt deleniti nesciunt aut consequuntur veniam, non molestiae, placeat dolorum maxime molestias reprehenderit repudiandae.
    Porro atque excepturi in explicabo delectus sit, itaque tempora modi a, error quam! Minus recusandae veniam doloremque dolore libero? Consectetur voluptatem cum iure temporibus consequatur obcaecati magnam reiciendis fuga beatae.
    Perspiciatis sint perferendis suscipit beatae obcaecati, itaque tempora, voluptas incidunt quibusdam culpa neque natus nesciunt quis autem. Laudantium commodi magni ipsam qui provident quasi, ratione et aperiam voluptate? Soluta, quae?
    Quod repudiandae nesciunt reprehenderit, quam sint voluptatum, reiciendis assumenda saepe asperiores similique perferendis aliquam natus dolore nostrum, ipsam blanditiis. Exercitationem voluptates tempora mollitia voluptas totam rem deserunt fuga architecto illum!
    Recusandae in, totam magni voluptatum dolores nobis rerum sit! Officiis asperiores, modi cum nisi cupiditate nulla obcaecati! Velit necessitatibus recusandae exercitationem rem nisi, praesentium, ex aspernatur amet sed saepe maiores?
    Suscipit aliquam aliquid quia, earum veritatis voluptatum! Unde enim sunt in corrupti hic et? Dignissimos officiis ducimus ipsum quia nulla deserunt voluptatibus sequi, nam, numquam obcaecati, expedita enim unde recusandae.
    Deserunt eligendi dolorum delectus cumque architecto libero provident, sapiente unde in. Ducimus et, molestias maiores a nobis dicta quod laborum recusandae cum dolorem. Est nostrum placeat alias repellendus obcaecati veniam!
    Asperiores, quod laborum ad saepe nesciunt libero! Error, eum fugit! Assumenda eius ipsam beatae, voluptatum porro pariatur dolorum. Esse, deleniti vitae! Repudiandae velit eveniet debitis fugit quibusdam distinctio illum maxime.
    Hic nulla minima quidem cum eveniet nesciunt, porro esse exercitationem accusamus autem aperiam ducimus at? Voluptate aspernatur consequatur dolorum amet vel molestiae suscipit? Autem id odit repudiandae aliquam soluta. Fuga.
    Debitis doloribus recusandae saepe est, ad molestiae quam! Quos inventore ex, a et aperiam quas sit, rerum ipsam voluptate autem nesciunt animi sed nostrum nulla enim, voluptates sapiente impedit ducimus.
    Corporis officia, eum explicabo quaerat harum vel laborum voluptatem illo nesciunt inventore voluptas a, ut voluptates sapiente et repellat sint quo laboriosam reprehenderit id saepe ex numquam temporibus provident? Dolorem.
    Est doloribus rerum cum illo sit odit tempora laudantium nulla a, reprehenderit error quaerat facilis fuga ipsum, dolorem voluptatum facere dolor consequatur esse ipsam. Ea delectus mollitia sit assumenda iure!
    Ullam recusandae fugit molestiae autem aliquam delectus, minima dignissimos asperiores modi corrupti totam velit obcaecati aspernatur eum numquam exercitationem! Quia laborum itaque nulla eum incidunt est non mollitia vero dolorem.
    Odit earum voluptatum possimus repellat nostrum ullam iste porro nobis ea voluptates rem nemo, quibusdam unde nisi cum delectus accusantium vitae culpa? Omnis beatae nostrum temporibus tempore eos sequi! Dicta.
    Esse, consequuntur soluta! Incidunt nisi architecto officia doloribus ad distinctio earum labore consequuntur officiis! Error ducimus tenetur velit ratione adipisci harum distinctio commodi, molestias quis, eligendi, obcaecati qui animi doloribus.
    Quasi non unde, magni incidunt odio praesentium error exercitationem sit tenetur temporibus accusamus mollitia harum aut nihil necessitatibus veritatis commodi laboriosam a cupiditate. Velit exercitationem, possimus error natus fugit aliquid.
    Necessitatibus atque totam sapiente eos fugiat temporibus laudantium adipisci, neque tempora, itaque eaque ad eius, vel eveniet accusantium qui! Enim eveniet velit assumenda id magni, nesciunt voluptas rerum eius soluta?
    Nobis ullam cumque qui, sunt numquam minima vel architecto facere, nisi fuga optio, tempore nostrum modi error consectetur officia dolorem? Deserunt voluptatem quod placeat sint, quo consequatur optio porro repudiandae.
    Aliquid quod sit assumenda temporibus ad officia. Quisquam sed temporibus repellat facere doloremque maxime eligendi, aspernatur corporis laudantium necessitatibus dolore sapiente. Laudantium eos nulla at porro autem repellat consequuntur cum.
    Laboriosam quos a, eos doloribus quaerat qui facere laudantium perferendis. Eaque similique aliquam suscipit exercitationem magni quae tenetur illum, quibusdam quo dolores id dignissimos eos aspernatur beatae inventore illo placeat.
    Quo nobis reiciendis vero et, laborum ullam vitae laudantium inventore sed non recusandae labore quam quis. Excepturi fuga impedit minima, incidunt quaerat ex ducimus quod vel voluptatem obcaecati, sed repudiandae?
    Dolorum quos dicta ratione veritatis ducimus praesentium illum quasi fugiat, est libero perspiciatis itaque! Explicabo odio facilis, beatae, recusandae cum nemo molestias nam praesentium, assumenda numquam velit sunt. Ratione, iste?
    Nisi mollitia architecto sit blanditiis suscipit enim omnis neque officiis asperiores dicta illo, reprehenderit culpa ut dolorem deserunt repudiandae. Blanditiis laborum illum corrupti dicta dolore asperiores ad quam ipsa repellendus?
    Vel deleniti aliquam totam alias impedit voluptas enim, cupiditate ea adipisci tenetur sed doloribus amet distinctio laborum, quo quidem, corrupti reprehenderit qui quaerat voluptatem exercitationem magnam consequuntur explicabo. In, sint.
    Temporibus aperiam incidunt rerum deserunt rem facere nostrum quo at accusantium, unde quia eligendi aspernatur ipsa molestiae adipisci dicta officiis? Incidunt neque perspiciatis laborum at veritatis dolorem, reprehenderit culpa eum?
    Ipsam harum rem recusandae saepe eius velit veniam assumenda reprehenderit ducimus, qui sit incidunt explicabo itaque. Dolor quod accusamus, facere non corrupti id eius, velit laudantium iste facilis pariatur eaque?
    Natus temporibus odit earum, reprehenderit tenetur aliquid iure alias iste exercitationem rerum harum sapiente similique veritatis, accusamus placeat eveniet minus optio! Ea est consectetur voluptatum veritatis debitis magni dolorem magnam?
    Ad omnis soluta possimus exercitationem eveniet assumenda officia consectetur animi praesentium, harum illum ab aperiam ducimus, repudiandae quaerat tempore voluptates vel enim laudantium, nisi illo! Consectetur sequi qui ipsa a.
    Accusamus, molestiae! Iure, aut. Sunt rem cupiditate, velit doloribus perferendis porro laboriosam amet, assumenda quaerat hic in provident. Inventore odit, voluptatibus quia nam suscipit officiis quasi quibusdam impedit eaque vel.
    Atque in ab cupiditate delectus, libero sed quibusdam ratione quidem praesentium? Voluptatem ex, explicabo tenetur qui corrupti unde hic non tempora cumque eius nostrum harum nemo. Quis perferendis minus est.
    Cumque, illo culpa dolorum aliquam tempore delectus sed similique inventore omnis cupiditate temporibus accusamus pariatur nulla corrupti! Officia ab molestiae qui earum libero? Iusto minima quos asperiores tempore beatae ipsa.
    Porro voluptatibus asperiores soluta eum laboriosam placeat, exercitationem rem veniam. Numquam cupiditate blanditiis repellendus delectus exercitationem ut minus doloribus expedita reiciendis, quam aliquam vel recusandae, velit, quaerat nam placeat quos.
    Excepturi labore praesentium quae deserunt, doloremque necessitatibus facilis vel ea odit iste, cum modi. Consectetur, ipsam quos unde consequuntur blanditiis, est sint consequatur porro, fuga doloremque dolore quo velit reiciendis.
    Voluptatibus quam, eos vel minima nostrum iusto cupiditate delectus veniam quae sed reprehenderit aperiam voluptas esse optio laudantium non inventore, enim alias est facere nobis. Recusandae expedita ipsum modi vel.
    Ipsum sunt excepturi odit illo alias obcaecati explicabo nihil cumque architecto, dolorum reprehenderit aut porro, tempora est aspernatur culpa iusto ipsam quas autem magnam. Magni, quos mollitia. Aut, enim iste.
    Reiciendis eveniet sint rerum, aliquid, vitae, odit rem voluptatem repudiandae in at esse labore odio eos nulla eius ea excepturi inventore autem atque adipisci deserunt recusandae. Quisquam perferendis a dignissimos.
    Inventore dolores at cupiditate in fugiat maiores, amet harum perspiciatis suscipit illum reprehenderit ad placeat pariatur, aliquid, excepturi non perferendis officia et quibusdam modi? Placeat voluptatem quidem eius odit libero?
    Porro accusantium ad quisquam maxime facere deleniti laudantium corrupti explicabo, libero tenetur? Alias expedita repudiandae est veniam suscipit sed modi id. Nihil iusto, dignissimos est quasi ut repudiandae facere similique!
    Quia molestiae maiores quis, reprehenderit minima magnam, perferendis corrupti eligendi dolor libero optio, similique labore officiis. Placeat eveniet, architecto quo facilis quidem sint natus repudiandae, libero cum reprehenderit et rerum?
</section-->