<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Illuminate\Http\Request;

class TagsController extends BaseController
{
    public function show(string $tag)
    {
        $posts = Post::orderBy('publish_date', 'DESC')
            ->withAllTags($tag)
            ->paginate(50);

        return view('front.tags.show', ['tag' => $tag, 'posts' => $posts]);
    }
}
