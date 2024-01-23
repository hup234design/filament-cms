<x-cms::layouts.events>
    <div class="prose max-w-none">
        <h1 class="mb-2">{{ $event->title }}</h1>
        <p class="flex gap-2 text-sm">
            <span>{{ $event->date->format('Y-m-d') }}</span>
            @if( $event->event_category_id )
                <span>//</span>
                <a href="{{ route('events.category', $event->event_category->slug) }}">
                    {{ $event->event_category->title }}
                </a>
            @endif
        </p>

        @if( $event->content ?? null )
            {!! tiptap_converter()->asHTML($event->content) !!}
        @endif
        <hr>
        <a href="{{ route('events.index', $event->slug) }}" class="no-underline">&larr; Back to all events</a>
    </div>
</x-cms::layouts.events>
