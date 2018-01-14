@extends('layouts.app')

@section('title'){{ $post->title }}@endsection

@section('content')
    <article>
        <div class="row">
            <h1>{{ $post->title }}</h1>
        </div>
        <div class="row">
            @include('front.partials.tagslist', ['tags' => $post->tags])
        </div>
        <div class="row">
            {!! $post->text !!}
        </div>
    </article>
@endsection
