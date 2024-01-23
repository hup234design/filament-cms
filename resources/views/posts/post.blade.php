<x-cms::layouts.posts>
    <div class="prose max-w-none">
        <h1 class="mb-2">{{ $post->title }}</h1>
        <p class="flex gap-2 text-sm">
            <span>{{ $post->publish_at }}</span>
            @if( $post->post_category_id )
                <span>//</span>
                <a href="{{ route('posts.category', $post->post_category->slug) }}">
                    {{ $post->post_category->title }}
                </a>
            @endif
        </p>

        @if( $post->content ?? null )
            {!! tiptap_converter()->asHTML($post->content) !!}
        @endif
        <hr>
        <a href="{{ route('posts.index', $post->slug) }}" class="no-underline">&larr; Back to all posts</a>
    </div>
</x-cms::layouts.posts>
