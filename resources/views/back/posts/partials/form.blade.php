{!! csrf_field() !!}

<div class="row">
    <div class="input-field col s12">
        <input name="title" id="title" type="text" placeholder="title" value="{{ old('title', $post->title) }}" />
        <label for="title">Title</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s12 tags">
        <input name="tags" id="tags" type="text" value="{{ old('tags', $post_tags->implode(', ') ) }}">
        <label for="tags">Tags</label>
    </div>
</div>

<div class="row">
    <div class="input-field col s12">
        <textarea name="text" id="post-body" name="text" class="materialize-textarea">{{ old('text', $post->markdown) }}</textarea>
        <label for="text">Text</label>
    </div>
</div>

<input type="submit" value="{{ $post->exists ? 'Update post' : 'Create post' }}" class="btn">
