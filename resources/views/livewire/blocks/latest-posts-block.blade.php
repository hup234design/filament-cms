<div>
    <div class="grid gap-8 lg:grid-cols-3">
        @foreach( $posts as $post )
            <div @class([
                "relative group aspect-video bg-gray-800 flex items-center justify-center p-8 text-center hover:bg-gray-700"
            ])>
                <a href="{{ route('posts.post', $post->slug) }}" class="text-white text-xl font-semibold">
                    {{ $post->title }}
                </a>
            </div>
        @endforeach
    </div>
</div>
