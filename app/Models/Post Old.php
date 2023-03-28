<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Support\Facades\File;
    use Spatie\YamlFrontMatter\YamlFrontMatter;

    class Post
    {
        public $title;
        public $excerpt;
        public $date;
        public $body;
        public $slug;

        /**
         * @param $title
         * @param $excerpt
         * @param $date
         * @param $body
         */
        public function __construct($title, $excerpt, $date, $body, $slug)
        {
            $this->title = $title;
            $this->excerpt = $excerpt;
            $this->date = $date;
            $this->body = $body;
            $this->slug=$slug;
        }

        public static function find($slug)
        {

//            // iteration 1
//            if(! file_exists(resource_path("posts/{$slug}.html"))) {
//                throw new ModelNotFoundException();
//            }
//
//            $post = cache() -> remember("posts.{$slug}", now()->addMinutes(20), function () use($path) {
//                var_dump('file_gets_contents');
//                return file_get_contents($path);
//            });

//            //iteration 2
//            // of all the blog posts, find the one with a slug
//            $posts = static::all();
//            return $posts->firstWhere('slug', $slug);
//
            //iteration 3
            $posts = static::all();
            $post = $posts->firstWhere('slug', $slug);

            if(! $post)
            {
                throw new ModelNotFoundException();
            }
            return $post;
        }

        public static function findOrFail($slug)
        {
            $posts = static::all();
            $post = $posts->firstWhere('slug', $slug);
            if(!$post)
            {
                throw new ModelNotFoundException();
            }
            return $post;
        }

        public static function all()
        {
            $files =  File::files( resource_path("posts"));
//            //iteration 1
//            return array_map(function ($file) {
////              return 'foo';
//                return $file->getContents();
//            }, $files);

//            //iteration 2
//            return collect($files)
//                ->map(fn($file) => YamlFrontMatter::parseFile($file))
//                ->map(fn($document) => new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug))
//                ->sortBy('date');

            //iteration 3
            return cache()->rememberForever('posts.all',function (){
                return collect(File::files( resource_path("posts")))
                    ->map(fn($file) => YamlFrontMatter::parseFile($file))
                    ->map(fn($document) => new Post ( $document->title, $document->excerpt, $document->date, $document->body() , $document->slug))
                    ->sortBy('date');
            });
        }
    }
?>
