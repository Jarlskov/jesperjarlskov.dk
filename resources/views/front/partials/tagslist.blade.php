@foreach ($post->tags as $tag)
    <div class="chip"><a href="{{ action('Front\TagsController@show', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a></div>
@endforeach
