@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-white font-serif">Search Users</h1>
    
    <form id="searchForm" method="GET" action="{{ route('search.user') }}" class="flex space-x-2 mb-4">
        <input type="text" id="searchInput" name="q" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600" placeholder="Search for a user...">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Search</button>
    </form>

    <div id="searchResults" class="space-y-4">
        <!-- Search results will be displayed here -->
        @if(isset($users))
            @foreach($users as $user)
                <a href="{{ route('view.profile', $user->id) }}" class="block p-2 bg-gray-800 rounded hover:bg-gray-700 transition text-white">
                    <strong>{{ $user->name }}</strong>
                </a>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        let query = this.value.trim();
        let resultsDiv = document.getElementById('searchResults');

        if (query.length > 0) {
            fetch(`/search-user?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsDiv.innerHTML = '';
                    
                    if (data.length === 0) {
                        resultsDiv.innerHTML = '<p class="text-gray-400">No users found.</p>';
                        return;
                    }

                    data.forEach(user => {
                        let userDiv = document.createElement('a');
                        userDiv.href = `/viewed-profile/${user.id}`;
                        userDiv.className = 'block p-2 bg-gray-800 rounded hover:bg-gray-700 transition text-white';
                        userDiv.innerHTML = `<strong>${user.name}</strong>`;
                        resultsDiv.appendChild(userDiv);
                    });
                });
        } else {
            resultsDiv.innerHTML = ''; // Clear results when input is empty
        }
    });
</script>
@endsection
