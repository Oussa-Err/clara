<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }

    /**
     * Display posts.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        // alternatively
        // $posts = Post::orderBy('date', 'desc');

        return view('/posts.index', ["posts" => $posts]);
    }

    /**
     * Display the blog
     */
    public function show(Post $post)
    {
        return view('posts.show', ["post" => $post]);
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        // we won't need Gate to check ownernship because auth middleware is present

        // validate
        $fields = $request->validate(
            [
                "title" => ['required', 'max:255'],
                "body" => ["required"]
            ]
        );

        // create
        Auth::user()->posts()->create($fields);

        // redirect with success message
        return back()->with('success', 'Your post was created');
    }

    /**
     * Show the page to edit the blog.
     */
    public function edit(Post $post)
    {
        // use modify policy to check owner
        Gate::authorize('modify', $post);

        return view('posts.edit', ["post" => $post]);
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Post $post)
    {
        // use modify policy to check owner
        Gate::authorize('modify', $post);

        // Validate
        $fields = $request->validate([
            "title" => ["required", "max:255"],
            "body" => ["required"]
        ]);

        // Update
        $post->update($fields);

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('update', 'Your post has been updated');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Post $post)
    {
        // use modify policy to check owner
        Gate::authorize('modify', $post);

        // Delete
        $post->delete();

        // Redirect back
        return back()->with('delete', 'your post was deleted!');
    }
}
