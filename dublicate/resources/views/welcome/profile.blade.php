@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-gray-900 rounded-lg shadow-lg text-white font-serif">
    <!-- Cover Photo -->
    <div class="relative">
        <img src="{{ $user->cover_photo ? asset('storage/' . $user->cover_photo) : 'https://via.placeholder.com/1200x400' }}" 
             class="w-full h-56 object-cover rounded-t-lg border-6 border-blue-500" alt="Cover Photo">
        
        <!-- Profile Picture -->
        <div class="absolute bottom-0 left-6 transform translate-y-1/2">
            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : 'https://via.placeholder.com/150' }}" 
                  class="w-32 h-32 object-cover rounded-full border-4 border-white shadow-lg " alt="Profile Picture">
        </div>

        <!-- Edit Profile Button -->
        <div class="absolute bottom-2 right-6">
            <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')"
                    class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-semibold shadow">
                Edit Profile
            </button>
        </div>
    </div>

    <!-- Profile Info -->
    <div class="px-6 pb-6 pt-16 text-center">
        <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
        <p class="text-gray-400">{{ $user->bio ?? 'No bio added yet.' }}</p>
        <p class="text-gray-400">Joined: {{ $user->created_at->format('F d, Y') }}</p>
        <p class="text-gray-400 mt-2 text-blue-500 font-bold"><span id="follow-count">{{ $user->followers->count() }}</span> Followers</p>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-gray-900 p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-xl font-bold mb-4 text-white">Edit Profile</h2>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        
            <label class="block text-gray-300">Name:</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-gray-700 px-3 py-2 rounded-lg text-white mb-2">
        
            <label class="block text-gray-300">Bio:</label>
            <textarea name="bio" class="w-full bg-gray-700 px-3 py-2 rounded-lg text-white mb-2">{{ $user->bio }}</textarea>
        
            <label class="block text-gray-300">Profile Image:</label>
            <input type="file" name="profile_image" class="w-full bg-gray-700 px-3 py-2 rounded-lg text-white mb-2">
        
            <label class="block text-gray-300">Cover Photo:</label>
            <input type="file" name="cover_photo" class="w-full bg-gray-700 px-3 py-2 rounded-lg text-white mb-2">
        
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded-lg text-sm font-semibold shadow">
                Save Changes
            </button>
            <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" 
                    class="ml-2 bg-gray-500 hover:bg-gray-600 px-4 py-2 rounded-lg text-sm font-semibold shadow">
                Cancel
            </button>
        </form>
        
    </div>
</div>
@endsection
