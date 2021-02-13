<article>
    <h3><a href="{{ action(['App\Http\Controllers\Front\PostsController', 'show'], ['postSlug' => $post->slug]) }}" class="black-text">{{ $post->title }}</a></h3>
    <time>{{ $post->publish_date->format('d. F Y') }}</time>
    <div>@include('front.partials.tagslist', ['tags' => $post->tags])</div>
    <div>
        {{ $post->summary }}
    </div>
</article>
