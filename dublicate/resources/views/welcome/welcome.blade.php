@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-white">All Posts</h1>
        <ul class="space-y-6">
            @foreach ($posts as $post)
                <li class="p-6 bg-gray-800 rounded-lg shadow">
                    <!-- Post Header -->
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-300">
                            <strong>{{ $post->user_name }}</strong>
                        </div>
                    </div>
                    
                    <!-- Post Content -->
                    <div class="mt-4 text-lg text-white">
                        {{ $post->posting }}
                    </div>
                    
                    <!-- Post Footer with Icons -->
                    <div class="mt-4 flex items-center space-x-6">
                        <!-- Like Button -->
                        <button class="flex items-center space-x-1 text-gray-400 hover:text-red-500 focus:outline-none">
                            <!-- Heart Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Like</span>
                        </button>
                        
                        <!-- Comment Button -->
                        <button class="flex items-center space-x-1 text-gray-400 hover:text-blue-500 focus:outline-none">
                            <!-- Comment Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 13a1 1 0 01-1 1H5l-4 4V4a1 1 0 011-1h14a1 1 0 011 1v9z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Comment</span>
                        </button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
