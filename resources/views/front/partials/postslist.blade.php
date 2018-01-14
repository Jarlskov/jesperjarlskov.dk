@foreach ($posts as $post)
    <article>
        @include('front.partials.post', ['post' => $post])
    </article>
@endforeach
