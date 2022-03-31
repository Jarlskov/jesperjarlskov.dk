<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            'title' => 'New post',
            'slug' => 'new-post',
            'user_id' => App\User::find(1),
            'text' => 'Super awesome post!',
            'publish_date' => new DateTime(),
            'updated_at' => new DateTime(),
            'published' => true,
            'user_id' => 1,
        ]);
    }
}
