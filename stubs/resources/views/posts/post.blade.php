<x-posts-layout>

    <x-page-header :header="$post->header" :title="$post->title" />

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

        @if($post->featured_image?->media )
            <x-cms-media-image-renderer
                :media="$post->featured_image?->media"
                :curation="$post->featured_image?->curation"
                imgClass="w-full"
            />
        @endif

        @if( $post->content ?? null )
            {!! tiptap_converter()->asHTML($post->content) !!}
        @endif

        @if( $post->blocks )
            <div class="mt-20">
                @foreach($post->blocks ?? [] as $block)
                    <div class="py-12">
                        @livewire($block['type'], ['blockData' => $block['data']])
                    </div>
                @endforeach
            </div>
        @endif

        <hr>
        <a href="{{ route('posts.index', $post->slug) }}" class="no-underline">&larr; Back to all posts</a>
    </div>
</x-posts-layout>
