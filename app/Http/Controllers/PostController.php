<?php

namespace App\Http\Controllers;

use App\Events\UserSubscribed;
use App\Mail\WelcomMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth', 'verified'], except: ['show', 'index']),
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

        // validate the request
        $request->validate(
            [
                "image" => ['nullable', "max:3000", "mimes:png,jpg,jpeg,webp"],
                "title" => ['required', 'max:255'],
                "body" => ["required"]
            ]
        );

        // Store Image if exists
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('blog_images', $request->image);
        }

        // Create the blog
        $post = Auth::user()->posts()->create([
            "image" => $path,
            "title" => $request->title,
            "body" => $request->body
        ]);

        // Send email for confirmation of creating blog
        Mail::to('mike@email.com')->send(mailable: new WelcomMail(Auth::user(), $post));


        // Redirect with success message
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
        $request->validate(
            [
                "image" => ['nullable', "max:3000", "mimes:png,jpg,jpeg,webp"],
                "title" => ['required', 'max:255'],
                "body" => ["required"]
            ]
        );

        // update image if exists
        $path = $post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $path = Storage::disk('public')->put('blog_images', $request->image);
        }

        // create the blog
        Auth::user()->posts()->update([
            "image" => $path,
            "title" => $request->title,
            "body" => $request->body
        ]);

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

        // delete the image in storage
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Delete the blog
        $post->delete();

        // Redirect back
        return back()->with('delete', 'your post was deleted!');
    }
}
