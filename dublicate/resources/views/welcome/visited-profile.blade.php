@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-900 rounded-lg shadow-lg text-white font-serif">
    <!-- Cover Photo -->
    <div class="relative">
        <img src="{{ $user->cover_photo ? asset('storage/' . $user->cover_photo) : 'https://via.placeholder.com/1200x400' }}" 
             class="w-full h-56 object-cover border-3 border-white rounded-t-lg" alt="Cover Photo">
        
        <!-- Profile Picture -->
        <div class="absolute bottom-0 left-6 transform translate-y-1/2">
            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/150' }}" 
                 class="w-32 h-32 object-cover rounded-full border-4 border-white shadow-lg" alt="Profile Picture">
        </div>
    </div>

    <!-- Profile Info -->
    <div class="px-6 pb-6 pt-16 text-center">
        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        <p class="text-gray-400">{{ $user->bio ?? 'No bio added yet.' }}</p>
        <p class="text-gray-400">Joined: {{ $user->created_at->format('F d, Y') }}</p>
        <p class="text-gray-400 mt-2 text-blue-500 font-bold"><span id="follow-count">{{ $user->followers->count() }}</span> Followers</p>
    
        <!-- Follow Button -->
        <button id="follow-btn" data-user-id="{{ $user->id }}" class="py-2.5 mt-5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            {{ auth()->user()->isFollowing($user->id) ? 'Unfollow' : 'Follow' }}
        </button>
        <button id="follow-btn"  class="py-2.5 mt-5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            Friends
        </button>
    

       
    </div>
    
    <script>
        document.getElementById('follow-btn').addEventListener('click', function() {
            let userId = this.getAttribute('data-user-id');
            
            fetch("{{ route('follow.toggle') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'followed') {
                    this.textContent = 'Unfollow';
                    document.getElementById('follow-count').textContent = parseInt(document.getElementById('follow-count').textContent) + 1;
                } else {
                    this.textContent = 'Follow';
                    document.getElementById('follow-count').textContent = parseInt(document.getElementById('follow-count').textContent) - 1;
                }
            });
        });
    </script>
    
    </div>
</div>
@endsection
