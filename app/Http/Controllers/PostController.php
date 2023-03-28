<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {

//        ddd(request()->all());
//        ddd(request()->file('thumbnail'));
////
        return view('posts.index', [
//            'posts' => Post::latest()->filter(request(['search', 'category', 'author ']))->get(),
            'posts' => Post::latest()->filter(request(['search', 'category', 'author ']))->paginate(6)->withQueryString(),
//            'categories' => Category::all(),
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [
            'post' => $post
        ]);
    }

}
