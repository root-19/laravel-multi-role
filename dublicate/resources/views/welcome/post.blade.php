@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-white">All Posts</h1>
        <a href="{{ route('welcome.create') }}" class="text-blue-400 hover:underline mb-6 inline-block">
            Create new Post
        </a>
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
                
                <!-- Post Footer with Reaction Button -->
                <div class="mt-4 flex items-center space-x-6">
                    <!-- Reaction (Heart) Button -->
                    <form action="{{ route('posts.react', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center space-x-1 text-gray-400 hover:text-red-500 focus:outline-none">
                            <!-- Heart Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                            </svg>
                            <!-- Reaction Count -->
                            <span class="ml-2 text-sm">{{ $post->reactions_count }}</span>
                        </button>
                    </form>
                    <!-- Comment Icon Button to toggle the comment section -->
                    <button type="button"
                            class="toggle-comment-btn flex items-center space-x-1 text-gray-400 hover:text-blue-500 focus:outline-none"
                            data-target="commentSection-{{ $post->id }}">
                        <!-- Comment Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 13a1 1 0 01-1 1H5l-4 4V4a1 1 0 011-1h14a1 1 0 011 1v9z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm">Comment</span>
                    </button>
                </div>

                <!-- Comment Section (initially hidden) -->
                <div id="commentSection-{{ $post->id }}" class="mt-4 hidden">
                    <!-- Comment Form -->
                    <div class="mb-4">
                        <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                            @csrf
                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your comment</label>
                            <textarea name="comment"  rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Write your Here here..."></textarea>
                            <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Comment</button>
                        </form>
                    </div>
                    
                    <!-- Display Comments -->
                    @if($post->comments->count())
                        <div class="space-y-2">
                            @foreach($post->comments as $comment)
                                <div class="p-2 bg-gray-700 rounded">
                                    <strong class="text-sm text-white">{{ $comment->user_name }}</strong>
                                    <p class="text-sm text-gray-300">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
</div>

@endsection
