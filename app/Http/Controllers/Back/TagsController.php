<?php

namespace App\Http\Controllers\Back;

use App\Post;
use Illuminate\Http\Request;

class TagsController extends BaseController
{
    public function index()
    {
        return array_values(Post::allTags());
    }
}
