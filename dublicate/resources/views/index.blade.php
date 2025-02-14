<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NextGen Threads - Programming Forum</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind fallback styles */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased dark:bg-gray-900 dark:text-gray-300">
        <header class="flex justify-between items-center px-6 py-4 bg-gray-800 text-white">
            <h1 class="text-2xl font-bold text-blue-500">NextGen Threads</h1>
            <nav>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 rounded hover:bg-blue-800">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="max-w-5xl mx-auto px-4 py-8">
            <section class="mb-10 text-center">
                <h2 class="mb-3 text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start"">Welcome to NextGen Threads</h2>
                <p class="text-lg text-gray-500 dark:text-gray-400">  A vibrant, community-driven forum where programmers of all skill levels come together to discuss coding challenges, share innovative solutions, and exchange industry insights. Whether you're a beginner looking for guidance, a seasoned developer troubleshooting complex issues, or an expert offering mentorship, this platform fosters a supportive environment for continuous learning. Engage in discussions about programming languages, software development trends, debugging strategies, and best practices. Collaborate on open-source projects, seek career advice, and stay updated with the latest technological advancements. Our goal is to build a space where knowledge flows freely, ideas turn into solutions, and every developer finds the support they need to grow and succeed..</p>
            </section>

            <!-- Latest Threads Section -->
            <section class="mb-10">
                <h2 class="text-2xl font-semibold mb-4">Latest Programming Discussions</h2>
                <div class="grid gap-6">
                    <!-- Thread 1 -->
                    <article class="p-6 bg-gray-700 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-2">Debugging JavaScript: Best Practices</h3>
                        <p>Discuss various debugging techniques, common pitfalls, and best tools for debugging JavaScript applications.</p>
                        <a href="#" class="text-blue-400 hover:underline">Join the discussion...</a>
                    </article>

                    <!-- Thread 2 -->
                    <article class="p-6 bg-gray-700 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-2">Python vs Java: Which One to Choose?</h3>
                        <p>A comparative discussion on Python and Java, their use cases, performance, and best practices.</p>
                        <a href="#" class="text-blue-400 hover:underline">Share your thoughts...</a>
                    </article>

                    <!-- Thread 3 -->
                    <article class="p-6 bg-gray-700 rounded-lg shadow">
                        <h3 class="text-xl font-semibold mb-2">How to Optimize SQL Queries?</h3>
                        <p>Share and learn tips on writing efficient SQL queries to improve database performance.</p>
                        <a href="#" class="text-blue-400 hover:underline">Learn more...</a>
                    </article>
                </div>
            </section>

            <!-- About the Forum -->
            <section class="mb-10">
                <h2 class="text-2xl font-semibold mb-4">About NextGen Threads</h2>
                <p>This forum is dedicated to programmers and tech enthusiasts who love discussing coding challenges, project ideas, and industry trends.</p>
                <p class="mt-4">Whether you're a beginner or an expert, join us to share knowledge, ask questions, and collaborate on projects.</p>
            </section>
        </main>
    </body>
</html>
