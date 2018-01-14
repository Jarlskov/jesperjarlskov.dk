<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class TagsController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = Post::orderBy('publish_date', 'DESC')
            ->withAllTags([$tag])
            ->paginate(50);

        return view('front.tags.show', ['tag' => $tag, 'posts' => $posts]);
    }
}
