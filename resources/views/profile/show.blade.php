<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
</head>
<body>
    <h1>Create New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div>
            <button type="submit">Create Post</button>
        </div>
    </form>

    <a href="{{ route('posts.index') }}">Back to Posts</a>
</body>
</html>