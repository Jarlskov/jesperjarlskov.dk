@foreach ($post->tags as $tag)
    <div class="chip"><a href="{{ action(['App\Http\Controllers\Front\TagsController', 'show'], ['tagSlug' => $tag->name]) }}">{{ $tag->name }}</a></div>
@endforeach
