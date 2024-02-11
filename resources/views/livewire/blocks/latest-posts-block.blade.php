<div>
    <div class="grid gap-8 lg:grid-cols-3">
        @foreach( $posts as $post )
            <div @class([
                "group aspect-video bg-eclipse-primary flex items-center justify-center p-8 text-center hover:bg-eclipse-secondary "
            ])>
                <a href="{{ route('posts.post', $post->slug) }}" class="text-white text-xl font-semibold">
                    {{ $post->title }}
                </a>
            </div>
        @endforeach
    </div>
</div>
