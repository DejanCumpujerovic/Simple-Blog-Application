<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment' => 'required|string|max:255',
        ]);
    
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = auth()->id(); // Assuming user is authenticated
        $comment->comment = $request->comment;
        $comment->save();
    
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->only(['comment']));
        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully.');
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);

        // Check if the authenticated user is the owner of the comment or the post
        if (Auth::id() === $comment->user_id || Auth::id() === $post->user_id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }
}