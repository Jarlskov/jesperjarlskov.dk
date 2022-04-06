<?php

namespace App\Console\Commands;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use stdClass;

class ImportWp extends Command
{
    protected $signature = 'import:wp';

    protected $description = 'Import the old WordPress database';

    public function handle(): void
    {
        $this->truncateTables();

        $user = User::first();

        $oldPosts = DB::table(env('WP_TABLE_PREFIX') . 'wp_posts')
            ->whereIn('post_status', ['draft', 'publish'])
            ->where('post_type', 'post')
            ->get();

        Post::unguard();

        collect($oldPosts)
            ->each(function (stdClass $oldPost) use ($user) {
                $post = Post::create([
                    'title' => $oldPost->post_title,
                    'text' => $this->sanitizePostContent($oldPost->post_content),
                    'wp_post_name' => $oldPost->post_name,
                    'slug' => $oldPost->post_name,
                    'publish_date' => Carbon::createFromFormat('Y-m-d H:i:s', $oldPost->post_date),
                    'published' => $oldPost->post_status === 'publish',
                    'user_id' => $user->id,
                ]);

                $this->attachTags($oldPost, $post);
            });
    }

    protected function truncateTables(): void
    {
        Schema::disableForeignKeyConstraints();

        Post::truncate();

        Schema::enableForeignKeyConstraints();
    }

    protected function sanitizePostContent(string $postContent): string
    {
        $postContent = str_replace('-700x458', '', $postContent);

        $postContent = str_replace('-700x459', '', $postContent);

        return $postContent;
    }

    protected function attachTags(stdClass $oldPost, Post $post): void
    {
        $table_prefix = env('WP_TABLE_PREFIX');

        $tags = DB::select(DB::raw("SELECT * FROM {$table_prefix}wp_terms
             INNER JOIN {$table_prefix}wp_term_taxonomy
             ON {$table_prefix}wp_term_taxonomy.term_id = {$table_prefix}wp_terms.term_id
             INNER JOIN {$table_prefix}wp_term_relationships
             ON {$table_prefix}wp_term_relationships.term_taxonomy_id = {$table_prefix}wp_term_taxonomy.term_taxonomy_id
             WHERE taxonomy IN ('post_tag', 'category') AND object_id = {$oldPost->ID}"));

        collect($tags)
            ->filter(function (stdClass $tag) {
                return $tag->slug !== 'uncategorized';
            })
            ->map(function (stdClass $tag) {
                return $tag->name;
            })
            ->pipe(function (Collection $tags) use ($post) {
                return $post->tag($tags);
            });
    }
}
