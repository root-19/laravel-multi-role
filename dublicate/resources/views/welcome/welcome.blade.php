@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Create Post</h1>
        <form action="{{ route('welcome.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <textarea name="posting" id="posting" placeholder="Write something ..." required class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
@endsection
