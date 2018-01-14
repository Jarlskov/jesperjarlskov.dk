@extends('layouts.app')

@section('title')
    {{ $tag->name }}
@endsection

@section('content')
    <h1>{{ $tag->name }}</h1>
    @include('front.partials.postslist', ['posts' => $posts])
@endsection
