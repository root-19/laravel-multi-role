@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center ">
    <div class="w-full max-w-xl p-6 bg-white rounded-lg shadow-lg">
        <!-- Header with Icon -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-8 h-8 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <!-- Plus icon -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Post
        </h1>
        <form action="{{ route('welcome.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <textarea 
                    name="posting" 
                    id="posting" 
                    placeholder="Share your thoughts..." 
                    required 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200"
                ></textarea>
            </div>
            <div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
                >
                    Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
