<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends BaseController
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::where('published', 1)
            ->orderBy('publish_date', 'DESC')
            ->with('tags')
            ->get();

        return view('front.posts.index', ['posts' => $posts]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('front.posts.show', ['post' => $post]);
    }
}
