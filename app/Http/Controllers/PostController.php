<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // Retrieve all posts from the database
        return view('posts.index', compact('posts'));
    }
    public function showDetailedPost($postId)
    {
        $post = Post::findOrFail($postId); // Retrieve the post
        $user = $post->user; // Get the user who created the post
        $comments = $post->comments; // Get all comments for the post

        return view('posts.show', compact('post', 'user', 'comments'));
    }

    public function show($postId)
    {
        $post = Post::with(['comments.user'])->findOrFail($postId); // Retrieve the post with its comments
        return view('posts.show', compact('post'));
    }

    public function commentDetails($commentId)
    {
        $comment = Comment::findOrFail($commentId); // Retrieve the comment
        $post = $comment->post; // Get the post to which the comment belongs

        return view('posts.commentDetails', compact('comment', 'post')); // Pass to a view
    }

    public function create()
    {      
        return view('posts.create'); // Return the view for creating a new post
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create the new post
        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => auth()->id(), // Associate the post with the authenticated user
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post created successfully!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
    
        // Check if the logged-in user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }
    
        return view('posts.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
    
        // Check if the logged-in user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post.');
        }
    
        // Perform update logic here
        $post->update($request->all());
    
        return redirect()->route('posts.show', $post->id)->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Check if the logged-in user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

}
