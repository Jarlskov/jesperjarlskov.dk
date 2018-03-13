@foreach ($post->tags as $tag)
    <div class="chip"><a href="{{ action('Front\TagsController@show', ['tag' => $tag->name]) }}">{{ $tag->name }}</a></div>
@endforeach
