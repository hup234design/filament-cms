<x-cms::layouts.events>

    <div class="prose max-w-none">
        <h1>Events | {{ $category->title }}</h1>
    </div>

    <div class="mt-12 space-y-12">
        @foreach( $events as $event )
            <div class="prose max-w-none">
                <h2 class="mb-2">{{ $event->title }}</h2>
                <p class="flex gap-2 text-sm">
                    <span>{{ $event->date->format('Y-m-d') }}</span>
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

    <hr class="my-12">

    <a href="{{ route('events.index', $event->slug) }}" class="no-underline">&larr; Back to all events</a>

</x-cms::layouts.events>
