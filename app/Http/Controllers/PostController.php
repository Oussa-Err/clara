<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
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
     * Display the blog
     */
    public function show(Post $post)
    {
        return view('posts.show', ["post" => $post]);
    }

    /**
     * Show the page to edit the blog.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ["post" => $post]);
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Post $post)
    {
        $fields = $request->validate([
            "title" => ["required", "max:255"],
            "body" => ["required"]
        ]);
        $post->update($fields);

        return redirect()->route('dashboard')->with('update', 'Your post has been updated');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('delete', 'your post was deleted!');
    }
}
