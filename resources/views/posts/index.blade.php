<x-layout>
    {{--    @foreach ($posts as $post)--}}
    {{--            <article class="{{ $loop->even ? "foobar" : 'mb-4' }}">--}}
    {{--                <h1>--}}
    {{--                    <a href="/posts/{{ $post->slug }}">--}}
    {{--                        {!! $post->title !!}--}}
    {{--                    </a>--}}
    {{--                </h1>--}}

    {{--                <p>--}}
    {{--                    By <a href="/authors/{{$post->author->username}}">{{ $post->author->name }}</a> and the post belongs to category: <a href="/categories/{{$post->category->id}}">{{ $post->category->name }}</a>--}}
    {{--                </p>--}}

    {{--                <div>--}}
    {{--                    Post Excerpt is : {{ $post->excerpt }}--}}
    {{--                </div>--}}
    {{--            </article>--}}
    {{--    @endforeach--}}

    @include('posts._header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <x-posts-grid :posts="$posts"/>

            {{ $posts->links() }}
        @else
            <p class="text-center"> No Posts Yet</p>
        @endif
    </main>

</x-layout>

