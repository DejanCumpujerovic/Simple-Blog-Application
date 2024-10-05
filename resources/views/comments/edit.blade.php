@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Comment</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" rows="3" required>{{ old('comment', $comment->comment) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
</div>
@endsection