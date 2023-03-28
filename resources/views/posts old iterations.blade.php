<!doctype html>


<title>My Blog Post</title>


<link rel="stylesheet" href="/app.css">

<body>
{{--    iteration 1--}}
{{--    <?php foreach ($posts as $post) : ?>--}}
{{--        <article class="{{ $loop->even ? "foobar" : 'mb-4' }}">--}}
{{--            <h1>--}}
{{--                <a href="/posts/<?= $post->slug; ?>">--}}
{{--                    <?= $post->title;  ?></h1>--}}
{{--                </a>--}}
{{--            <div>--}}
{{--                 <?= $post->excerpt; ?>--}}
{{--            </div>--}}
{{--        </article>--}}
{{--    <?php endforeach; ?>--}}

{{--    iteration 2--}}
    @foreach ($posts as $post)
    <article class="{{ $loop->even ? "foobar" : 'mb-4' }}">
        <h1>
            <a href="/posts/<?= $post->slug; ?>">
                {{$post->title }}
            </a>
        </h1>

        <div>
            {{ $post->excerpt }}
        </div>
    </article>
    @endforeach
</body>

