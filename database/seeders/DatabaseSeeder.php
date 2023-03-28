<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Comment::truncate();
//        Post::truncate();
//        User::truncate();
        Category::truncate();

        User::factory(3)->create();

         $user = User::factory()->create([
             'name' => 'Hamid Iqbal',
             'email' => 'hamidiqbal598@gmail.com',
             'username' => 'hamidiqbal598',
             'password' => bcrypt('12345678')
         ]);
        $user2 = User::factory()->create([
            'name' => 'Ahmad Iqbal',
            'email' => 'ahmadiqbal598@gmail.com',
            'username' => 'ahmadiqbal598',
        ]);

        $family = Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);
        $work = Category::create([
            'name' => 'Work',
            'slug' => 'work',
        ]);
        $hobbies = Category::create([
            'name' => 'Hobbies',
            'slug' => 'hobbies',
        ]);
        Post::create([
            'category_id' => $family->id,
            'title' => 'My Family Post',
            'slug' => 'my-family-post',
            'excerpt' => 'Excerpt for the post',
            'body' => 'Lorem adddaaaaddaasa',
            'user_id' => $user->id,
        ]);
        Post::create([
            'category_id' => $work->id,
            'title' => 'My Work Post 1',
            'slug' => 'my-work-post-1',
            'excerpt' => 'Excerpt for the post',
            'body' => 'Lorem adddaaaaddaasa',
            'user_id' => $user->id,
        ]);
        Post::create([
            'category_id' => $family->id,
            'title' => 'My Work Post 2',
            'slug' => 'my-work-post-2',
            'excerpt' => 'Excerpt for the work post 2 ',
            'body' => 'Lorem adddaaaaddaasa',
            'user_id' => $user->id,
        ]);
        Post::create([
            'category_id' => $hobbies->id,
            'title' => 'My Hobby Post 1',
            'slug' => 'my-hobby-post-1',
            'excerpt' => 'Excerpt for the hobby post 1',
            'body' => 'Lorem adddaaaaddaasa hobbyyyyyy',
            'user_id' => $user2->id,
        ]);
        Post::create([
            'category_id' => $hobbies->id,
            'title' => 'My Hobby Post 2',
            'slug' => 'my-hobby-post-2',
            'excerpt' => 'Excerpt for the hobby post 2',
            'body' => 'Lorem adddaaaaddaasa hobbyyyyyy',
            'user_id' => $user2->id,
        ]);
        Post::create([
            'category_id' => $hobbies->id,
            'title' => 'My Hobby Post 3',
            'slug' => 'my-hobby-post-3',
            'excerpt' => 'Excerpt for the hobby post 3',
            'body' => 'Lorem adddaaaaddaasa hobbyyyyyy',
            'user_id' => $user->id,
        ]);
    }
}
