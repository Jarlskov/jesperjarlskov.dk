@extends('layouts.app')

@section('content')
    <form action="{{ action('Back\PostsController@index') }}" method="get" id="backend-post-filters">
        <div class="input-field">
            <select name="filter">
                <option value="all">Show all</option>
                <option value="published">Published only</option>
                <option value="draft">Draft only</option>
            </select>
        </div>
    </form>

    <ul id="backend-postlist">
        @foreach ($posts as $post)
            <li><a href="{{ action('Back\PostsController@edit', $post) }}">{{ $post->title }} {{ !$post->published ? ' - draft' : '' }}</a><span>delete</span></li>
        @endforeach
    </ul>
    <div class="fixed-action-btn">
        <a href="/admin/posts/create" class="btn-floating btn-large waves-effect waves-light green"><i class="material-icons">add</i></a>
    </div>
@endsection
