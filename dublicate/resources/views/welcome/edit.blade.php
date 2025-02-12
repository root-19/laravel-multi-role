@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold mb-6 text-white">Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <textarea name="posting" class="w-full p-2 border border-gray-300 rounded" rows="5">{{ old('posting', $post->posting) }}</textarea>
                @error('posting')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
                Update Post
            </button>
        </form>
    </div>
@endsection
