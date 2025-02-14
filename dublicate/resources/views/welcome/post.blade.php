@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-6 font-serif">
        <h1 class="text-3xl font-bold mb-6 text-white font-serif">Your Threads</h1>
        <a href="{{ route('welcome.create') }}" class="text-blue-400 hover:underline mb-6 inline-block font-serif">
            Create new Post
        </a>
        <ul class="space-y-6">
            @foreach ($posts as $post)
            @if ($post->user_id === auth()->id())
            <li class="p-6 bg-gray-800 rounded-lg shadow">
                <!-- Post Header with Edit & Delete Buttons -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 text-white rounded-full flex items-center justify-center text-lg font-bold ring-2 ring-gray-300 dark:ring-gray-500">
                        {{ strtoupper(substr($post->user_name, 0, 1)) }}
                    </div>
                    <div class="text-sm text-gray-300">
                        <strong>{{ $post->user_name }}</strong>
                    </div>
                   
                    <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        
                        <!-- Edit Button -->
                        <a href="{{ route('posts.edit', $post->id) }}" class="text-yellow-400 hover:text-yellow-500">
                            ✏️ Edit
                        </a>
                        <!-- Delete Button -->
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-500">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="mt-4 text-lg text-white">
                    {{ $post->posting }}
                </div>

                <!-- Post Image (Centered and Resized) -->
                @if ($post->image)
                    <div class="flex justify-center mt-4">
                        <img src="{{ asset('storage/' . $post->image) }}" 
                            alt="Post Image" 
                            class="rounded-lg max-w-full md:max-w-lg">
                    </div>
                @endif

                <!-- Post Footer with Reaction & Comment Buttons -->
                <div class="mt-4 flex items-center space-x-6">
                    <!-- Reaction (Heart) Button -->
                    <form action="{{ route('posts.react', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1 text-gray-400 hover:text-red-500 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            <span class="ml-2 text-sm">{{ $post->reactions_count }}</span>
                        </button>
                    </form>

                    <!-- Comment Button -->
                    <button type="button"
                        class="toggle-comment-btn flex items-center space-x-1 text-gray-400 hover:text-blue-500 focus:outline-none"
                        data-target="commentSection-{{ $post->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 13a1 1 0 01-1 1H5l-4 4V4a1 1 0 011-1h14a1 1 0 011 1v9z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm">Comment</span>
                    </button>
                </div>

                <!-- Comment Section (Hidden Initially) -->
                <div id="commentSection-{{ $post->id }}" class="mt-4 hidden">
                    <!-- Comment Form -->
                    <div class="mb-4">
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                            @csrf
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your comment</label>
                            <textarea name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Write your comment here..."></textarea>
                            <button type="submit" class="py-2.5 px-5 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Comment</button>
                        </form>
                    </div>

                    <!-- Display Comments -->
                    @if($post->comments->count())
                    <div class="space-y-2">
                    @foreach($post->comments as $comment)
                        <div class="p-2 bg-gray-700 rounded flex items-start space-x-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-500 text-white rounded-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($comment->user_name, 0, 1)) }}
                                </div>
                            </div>
                            <div>
                                <div class="text-sm text-gray-300 font-bold">
                                    {{ $comment->user_name }}
                                </div>
                                <p class="text-sm text-white">{{ $comment->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @endif
                </div>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
@endsection
