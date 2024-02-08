<x-posts-layout>

    <x-page-header title="Posts" />

    <div class="mt-12 space-y-12">
        @foreach( $posts as $post )
            <div class="prose max-w-none">
                <h2 class="mb-2">{{ $post->title }}</h2>
                <p class="flex gap-2 text-sm">
                    <span>{{ $post->publish_at }}</span>
                    @if( $post->post_category_id )
                        <span>//</span>
                        <a href="{{ route('posts.category', $post->post_category->slug) }}">
                            {{ $post->post_category->title }}
                        </a>
                    @endif
                </p>
                <p>{{ nl2br($post->summary) }}</p>
                <a href="{{ route('posts.post', $post->slug) }}" class="no-underline">Read More &rarr;</a>
            </div>
       @endforeach
    </div>

    @if( $posts->hasPages() )
        <hr class="my-12">
        <div>
            {{ $posts->links() }}
        </div>
    @endif

</x-posts-layout>
