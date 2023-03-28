<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\AdminPostController;
use \App\Http\Controllers\SessionController;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//
////    //iteration 1 (works with iteration 1 of Post.php all function)
////    $posts = Post::all();
//////    ddd($posts);
////    return view('posts', [
////        'posts' => $posts
////    ]);
//
//    $files = File::files(resource_path("posts"));
//
////    //iteration 2
////    $posts = [];
////    foreach ($files as $file) {
////        $document = YamlFrontMatter::parseFile($file);
//////        ddd($document);
////        $posts [] = new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug);
////    }
//
////    //iteration 3
////    $posts = array_map(function ($file) {
////        $document = YamlFrontMatter::parseFile($file);
////        return new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug);
////    }, $files);
//
////    //iteration 4
////    $posts = collect($files)->map(function ($file) {
////        $document = YamlFrontMatter::parseFile($file);
////        return new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug);
////    });
//
////    //iteration 5
////    $posts = collect($files)
////        ->map(fn($file) => YamlFrontMatter::parseFile($file))
////        ->map(fn($document) => new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug));
//
//    // iteration 6 (as all function is changed to iteration 2)
////    \Illuminate\Support\Facades\DB::listen(function ($query) {
////        logger($query->sql);
////    });
////    $posts = Post::all();
////    $posts = Post::latest()->with('category', 'author')->get();
//    $posts = Post::latest()->get();
//    if(request('search')) {
//        $posts
//            ->where('title', 'like', '%'.request('search').'%')
//            ->where('body', 'like', '%'.request('search').'%');
//    }
//    return view('posts', [
//        'posts' => $posts,
//        'categories' => Category::all()
//    ]);
//})->name('home');

Route::get('/', [PostController::class, 'index'])->name('home');

//Route::get('posts/{post}', function($slug) {
//    $path = __DIR__ . "/../";
//    if(! file_exists($path)) {
//        return redirect('/');
//    }
//
//    $post = cache() -> remember("posts.{$slug}", now()->addMinutes(20), function () use($path) {
//        var_dump('file_gets_contents');
//        return file_get_contents($path);
//    });
//
//    return view('post', [
//        'post' => $post
//    ]);
//})->where('post', '[A-z_\-]+');

//Route::get('posts/{post}', function ($slug) {
//    $post = Post::find($slug);
//
//    return view('post', [
//        'post' => $post
//    ]);
//})->where('post', '[A-z_\-]+');

////dynamic version - 1
//Route::get('posts/{post}', function ($id) {
//    $post = Post::find($id);
//
//    return view('post', [
//        'post' => $post
//    ]);
//});

////dynamic version - 2
//Route::get('posts/{post}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()
//    return view('post', [
//        'post' => $post
//    ]);
//});

////dynamic version - 3
//Route::get('posts/{post:slug}', function (Post $post) { // Post::where('slug', $post)->firstOrFail()
//    return view('post', [
//        'post' => $post
//    ]);
//});

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('show');
Route::post('posts/{post:slug}/comments', [PostCommentController::class, 'store']);

//Route::get('categories/{category:slug}', function (Category $category) { // Post::where('slug', $post)->firstOrFail()
//    return view('posts', [
////        'posts' => $category->posts->load(['category','author'])
//        'posts' => $category->posts,
//        'categories' => Category::all(),
//        'currentCategory' => $category
//    ]);
//})->name('category');


//Route::get('authors/{author:username}', function (User $author) { // Post::where('slug', $post)->firstOrFail()
//    return view('posts.index', [
////        'posts' => $author->posts->load(['category','author'])
//        'posts' => $author->posts,
////        'categories' => Category::all()
//    ]);
//});

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');


//Route::post('admin/ posts/create',[PostController::class, 'create'])->middleware('admin');

Route::middleware('can:admin')->group(function () {
    Route::resource('admin/posts', AdminPostController::class)->except('show');
});

