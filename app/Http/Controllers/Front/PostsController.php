<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', 1)
            ->orderBy('publish_date', 'DESC')
            ->with('tags')
            ->get();

        return view('front.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('front.posts.show', ['post' => $post]);
    }
}
