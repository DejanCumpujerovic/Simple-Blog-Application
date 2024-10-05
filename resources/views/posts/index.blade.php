@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @foreach ($posts as $post)
        <div class="post">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            <p>By: {{ $post->user->name }}</p>

            <!-- Edit Button -->
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">EditPost</a>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-warning">Unesi komentare</a>

            <!-- Display Comments -->
            <h3>Comments:</h3>
            <ul>
                @foreach($post->comments as $comment)
            <li>
                <strong>{{ $comment->user->name }}</strong>: {{ $comment->comment }}
            </li>
                @endforeach
            </ul>

            <div>
                ---------------------
            </div>
            @if (auth()->user()->id == $post->user_id)
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
