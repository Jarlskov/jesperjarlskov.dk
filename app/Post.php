<?php

namespace App;

use App\Scopes\PublishedScope;
use App\User;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use League\CommonMark\CommonMarkConverter;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Feedable
{
    use Taggable, HasSlug;

    protected $fillable = [
        'title',
        'text',
        'published',
        'wp_post_name',
        'slug',
        'publish_date',
    ];

    protected $dates = [
        'created_at',
        'publish_date',
        'updated_at',
    ];

    protected $casts = [
        'published' => 'bool',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope);
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id((string) $this->id)
            ->title($this->title)
            ->summary($this->summary)
            ->updated($this->updated_at)
            ->link($this->slug)
            ->authorName($this->author->name)
            ->authorEmail($this->author->email);
    }

    public static function getFeedItems() : Collection
    {
        return self::where('published', 1)
            ->orderBy('publish_date', 'desc')
            ->with('author')
            ->get()
            ->toBase();
    }

    /**
     * Implements HasSlug::getSlugOptions().
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getSummaryAttribute() : string
    {
        return substr(strip_tags($this->text), 0, 250) . '...';
    }

    public function getTextAttribute(string $original) : string
    {
        $converter = new CommonMarkConverter();

        return $converter->convertToHtml($original);
    }

    public function getMarkdownAttribute() : string
    {
        return $this->getOriginal('text', '');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function updateAttributes(User $user, Array $attributes): self
    {
        $this->title = $attributes['title'];
        $this->text = $attributes['text'];
        $this->publish_date = $attributes['publish_date'] ?? now();
        $this->published = isset($attributes['published']) && $attributes['published'] ? true : false;
        $this->user_id = $user->id;

        $this->save();

        return $this;
    }
}
