<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        return Tag::all()->map(function($tag) {
            return [
                'name' => $tag->name,
                'slug' => $tag->slug,
            ];
        });
    }
}
