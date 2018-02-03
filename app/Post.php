<?php

namespace App;

use App\Scopes\PublishedScope;
use App\User;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Builder;
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope);
    }

    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->summary)
            ->updated($this->updated_at)
            ->link($this->slug)
            ->author($this->author->name);
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

    public function getTextAttribute($original) : string
    {
        $converter = new CommonMarkConverter();

        return $converter->convertToHtml($original);
    }

    public function getMarkdownAttribute() : string
    {
        return $this->getOriginal('text', '');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('published', true);
    }

    public function updateAttributes(User $user, Array $attributes)
    {
        $this->title = $attributes['title'];
        $this->text = $attributes['text'];
        $this->publish_date = $attributes['publish_date'] ?? now();
        $this->published = $attributes['published'] ?? false;

        $this->save();

        return $this;
    }
}
