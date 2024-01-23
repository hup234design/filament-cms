<x-cms::layouts.events>

    <div class="prose max-w-none">
        <h1>Events</h1>
    </div>

    <div class="mt-12 space-y-12">
        @foreach( $events as $event )
            <div class="prose max-w-none">
                <h2 class="mb-2">{{ $event->title }}</h2>
                <p class="flex gap-2 text-sm">
                    <span>{{ $event->date->format('Y-m-d') }}</span>
                    @if( $event->event_category_id )
                        <span>//</span>
                        <a href="{{ route('events.category', $event->event_category->slug) }}">
                            {{ $event->event_category->title }}
                        </a>
                    @endif
                </p>
                <p>{{ nl2br($event->summary) }}</p>
                <a href="{{ route('events.event', $event->slug) }}" class="no-underline">Read More &rarr;</a>
            </div>
       @endforeach
    </div>

    @if( $events->hasPages() )
        <hr class="my-12">
        <div>
            {{ $events->links() }}
        </div>
    @endif

</x-cms::layouts.events>
