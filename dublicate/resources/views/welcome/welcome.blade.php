@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="hidden md:flex flex-col w-64 bg-gray-900 text-white h-screen fixed p-6 shadow-lg overflow-y-auto">
        <h1 class="text-3xl font-bold mb-6 text-white font-serif">Threaders</h1>
        <ul class="space-y-6">
            @foreach ($users as $user)
            <a href="{{ route('visited.profile', $user->id) }}" 
               class="flex items-center space-x-3 mb-4 p-2 bg-gray-800 rounded-lg hover:bg-gray-700 transition">
                <div class="w-12 h-12  text-white rounded-full flex items-center justify-center text-lg font-bold">
                    <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/150' }}" class="w-12 h-12 rounded-full " />
                </div>
                <div class="text-sm text-gray-300 font-semibold font-serif"> 
                    {{ $user->name }}
                    <p class="text-gray-400 mt-2 text-blue-500 font-bold"><span id="follow-count">{{ $user->followers->count() }}+</span> Followers</p>
                </div>
            </a>
        @endforeach
    </div>
    

    <!-- Main Content -->
    <div class="flex-1 max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-white font-serif">Threads</h1>

        <ul class="space-y-6 font-serif">
            @foreach ($posts as $post)
                <li class="p-6 bg-gray-800 rounded-lg shadow">
                    <!-- Post Header -->
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12  text-white rounded-full flex  items-center justify-center text-lg p-1 rounded-full font-bold ring-2 ring-gray-300 dark:ring-gray-500">
                            {{ strtoupper(substr($post->user_name, 0, 1)) }}
                        </div>
                        <div class="text-sm text-gray-300 font-bold font-serif">
                            {{ $post->user_name }}
                        </div>
                    </div>
                    
                    <!-- Post Content -->
                    <div class="mt-4 text-lg text-white font-serif">
                        {{ $post->posting }}
                    </div>
         
                    @if ($post->image)
    
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-2 rounded-lg w-64 h-auto object-cover">

@endif

                    
                    <!-- Post Footer -->
                    <div class="mt-4 flex items-center space-x-6">
                        <form action="{{ route('posts.react', $post->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 text-gray-400 hover:text-red-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.343l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                </svg>
                                <span class="ml-2 text-sm">{{ $post->reactions_count }}</span>
                            </button>
                        </form>
                        <button type="button"
                                class="toggle-comment-btn flex items-center space-x-1 text-gray-400 hover:text-blue-500 focus:outline-none"
                                data-target="commentSection-{{ $post->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 13a1 1 0 01-1 1H5l-4 4V4a1 1 0 011-1h14a1 1 0 011 1v9z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm">Comment</span>
                        </button>
                    </div>

                    <!-- Comment Section -->
                    <div id="commentSection-{{ $post->id }}" class="mt-4 hidden">
                        <div class="mb-4">
                            <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                                @csrf
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your comment</label>
                                <textarea name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mb-4" placeholder="Write your comment here..."></textarea>
                                <button type="submit" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Comment</button>
                            </form>
                        </div>
                        
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
            @endforeach
        </ul>
    </div>
</div>
@endsection

