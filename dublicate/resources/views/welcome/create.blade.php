@extends('layouts.app')

@section('content')
 <h1>create post</h1>
 <form action="{{route('welcome.store')}}" method="POST">

    @csrf
    <textarea name="posting" id="posting" placeholder="write somthing ..." required></textarea>
    <button type="submit">Post</button>
 </form>
 @endsection