<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function show(string $tags)
    {
        $posts = Post::orderBy('publish_date', 'DESC')
            ->withAllTags($tags)
            ->paginate(50);

        return view('front.tags.show', ['tags' => $tags, 'posts' => $posts]);
    }
}
