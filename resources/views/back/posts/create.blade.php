@extends('layouts.app')

@section('title')
New post
@endsection

@section('content')
    <h1>New post</h1>

    <form class="col s12" method="post" action="{{ action('Back\PostsController@store') }}">
        @include('back.posts.partials.form', ['post' => $post, 'post_tags' => collect()])
    </form>
@endsection
