<?php

namespace App\Http\Controllers;

use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index')->with('posts', $posts);
    }

    public function show(int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }
}
