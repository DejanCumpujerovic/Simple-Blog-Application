<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


use App\Models\Post;

class CheckPostAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::findOrFail($request->route('id'));

        // Check if the logged-in user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            // Redirect with an error message
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post.');
        }

        return $next($request);
    }
}
