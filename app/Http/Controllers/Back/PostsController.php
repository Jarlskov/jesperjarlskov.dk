<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $posts = Post::when($request->has('filter'), function ($posts) use ($request) {
            if ($request->get('filter') === 'all') {
                return $posts;
            }

            return $posts->where('published', $request->get('filter') === 'published');
        })
            ->orderBy('published', 'ASC')
            ->orderBy('publish_date', 'DESC')
            ->get();

        return view('back.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $post = new Post();

        $post->publish_date = now();

        return view('back.posts.create', ['post' => $post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request)
    {
        $post = (new Post())->updateAttributes($request->user(), $request->validated());
        $post->tag($request->get('tags', ''));

        $request->session()->flash('success', 'Post saved');

        return redirect()->action('Back\PostsController@edit', $post->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('back.posts.edit', ['post' => $post, 'post_tags' => $post->tags->pluck('name')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->updateAttributes($request->user(), $request->validated());
        $post->retag($request->get('tags', ''));

        $request->session()->flash('success', 'Post updated');

        return redirect(action('Back\PostsController@edit', ['post' => $post->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $postId
     * @return string
     */
    public function destroy($postId)
    {
        Post::find($postId)->delete();

        return "Post {$postId} deleted";
    }
}
