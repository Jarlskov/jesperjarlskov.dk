<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        return array_values(Post::allTags());
    }
}
