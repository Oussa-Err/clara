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
     * Store a newly created resource in storage.
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
     * Display the post
     */
    public function show(Post $post)
    {
        return view('posts.post', ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('deleted', 'your post was deleted!');
    }
}
