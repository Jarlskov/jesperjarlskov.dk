@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <div><a href="{{ action('Front\PostsController@show', ['post' => $post->slug]) }}" target="_blank">{{ $post->slug }}</a></div>

    <form class="col s12" method="post" action="{{ action('Back\PostsController@update', ['post' => $post->id]) }}">
        <input type="hidden" name="_method" value="put" />

        @include('back.posts.partials.form', ['post' => $post, 'post_tags' => $post_tags])
    </form>
@endsection
