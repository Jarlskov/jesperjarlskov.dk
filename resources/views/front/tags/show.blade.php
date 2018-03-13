@extends('layouts.app')

@section('title')
    {{ $tag }}
@endsection

@section('content')
    <h1>{{ $tag }}</h1>
    @include('front.partials.postslist', ['posts' => $posts])
@endsection
