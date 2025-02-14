@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center ">
    <div class="w-full max-w-xl p-6 bg-gray-800 rounded-lg shadow-lg">
        <!-- Header with Icon -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-8 h-8 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <!-- Plus icon -->
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
          <span class="text-2xl text-blue-500"> Write Post </span>
        </h1>
        <form action="{{ route('welcome.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="posting" class="sr-only">Your Thought</label>
                        <textarea name="posting" id="posting" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                    </div>
                    <div class="flex items-center justify-between px-3 py-2 border-t dark:border-gray-600 border-gray-200">
                        <label class="cursor-pointer bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 16 5-7 6 6.5m6.5 2.5L16 13l-4.286 6M14 10h.01M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                              </svg>
                              
                            <input type="file" name="image" class="hidden">
                        </label>
                        <button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-gray-200 bg-blue-500 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            Post Thought
                        </button>
                    </div>
                </div>
            </div>
         
              
        </form>
        
    </div>
</div>
@endsection
