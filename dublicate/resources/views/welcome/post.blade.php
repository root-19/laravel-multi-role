@extends('layouts.app')

@section('content')
<h1>all Post</h1>
<a href="{{route('welcome.create')}}">Create new Post</a>

<ul>
    @foreach ($posts as $post)
    <li>
        <strong>User {{ $post->user_id}}</strong>: {{ $post->posting}}
    </li>
    @endforeach
</ul>
@endsection