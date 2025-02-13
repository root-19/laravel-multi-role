<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Threads</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* ! tailwindcss v3.4.17 | MIT License | https://tailwindcss.com */
                /* (Your existing Tailwind fallback CSS styles here) */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <!-- Header: Contains Home link, Title, and Authentication Navigation -->
        <header class="grid grid-cols-3 items-center gap-2 py-10">
            <!-- Left Column: Home Link -->
            <div class="flex justify-start">
                {{-- <a href="{{ url('/') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Home
                </a> --}}
            </div>

            <!-- Center Column: Page Title -->
            <div class="flex justify-center">
                <h1 class="text-2xl font-bold">Threads</h1>
            </div>

            <!-- Right Column: Authentication Navigation -->
            <div class="flex justify-end">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </header>

        <!-- Main Content: About Threads -->
        <main class="max-w-5xl mx-auto px-4">
            <!-- Section: Introduction to Threads -->
            <section class="mb-12">
                <h2 class="text-3xl font-bold mb-4">Welcome to Threads</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Threads are the heart of our community! Here, you can dive into discussions on a wide range of topics, share your ideas, ask questions, and connect with others.
                </p>
            </section>

            <!-- Section: Sample Threads Data -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-4">Latest Threads</h2>
                <div class="space-y-6">
                    <!-- Thread 1 -->
                    <article class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-2">Thread: Data  Insights</h3>
                        <p class="text-gray-800 dark:text-gray-200">
                            This thread is all about sharing insights on "Data". Discuss the latest trends, share your experiences, and learn from the community.
                        </p>
                        <a href="#" class="inline-block mt-3 text-blue-600 dark:text-blue-400 hover:underline">
                            Read more...
                        </a>
                    </article>

                    <!-- Thread 2 -->
                    <article class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-2">Thread: Exploring New Data Concepts</h3>
                        <p class="text-gray-800 dark:text-gray-200">
                            Dive into discussions about emerging data concepts. Whether you're a beginner or an expert, join the conversation and share your knowledge.
                        </p>
                        <a href="#" class="inline-block mt-3 text-blue-600 dark:text-blue-400 hover:underline">
                            Read more...
                        </a>
                    </article>
                </div>
            </section>

            <!-- Section: About the Platform -->
            <section class="mb-12">
                <h2 class="text-2xl font-bold mb-4">About Our Threads Platform</h2>
                <p class="text-gray-700 dark:text-gray-300">
                    Our platform is designed to facilitate engaging discussions and knowledge sharing. Whether you're here to ask questions, share your expertise, or just browse through interesting topics, we welcome you to be a part of our growing community.
                </p>
                <p class="text-gray-700 dark:text-gray-300 mt-4">
                    Enjoy exploring, and feel free to start your own thread to contribute to the discussion!
                </p>
            </section>
        </main>
    </body>
</html>
