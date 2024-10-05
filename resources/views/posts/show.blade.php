<!-- Display the Post -->
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
<p>Written by: {{ $post->user->name }}</p>

<!-- Display Comments -->
<h3>Comments:</h3>
<ul>
    @foreach ($post->comments as $comment)
    <div class="comment">
        <p>{{ $comment->content }}</p>

        <!-- Check if the user can delete the comment -->      
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                @csrf
                @method('DELETE')
                <li>
                    {{ $comment->comment }}:<button type="submit" class="btn btn-danger">Delete Comment</button>
                </li>
            </form>
    </div>
    @endforeach
</ul>

<!-- Comment Form -->
<h3>Add a Comment:</h3>
<form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="comment" required placeholder="Add your comment here..."></textarea>
    <button type="submit">Submit Comment</button>
</form>

