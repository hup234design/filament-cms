<x-cms::layouts.services>

    <x-cms::page-header heading="Services" :subheading="$category->title"  />

    <div class="mt-12 space-y-12">
        @foreach( $services as $service )
            <div class="prose max-w-none">
                <h2 class="mb-2">{{ $service->title }}</h2>
                <p>{{ nl2br($service->summary) }}</p>
                <a href="{{ route('services.service', $service->slug) }}" class="no-underline">Read More &rarr;</a>
            </div>
       @endforeach
    </div>

    @if( $services->hasPages() )
        <hr class="my-12">
        <div>
            {{ $services->links() }}
        </div>
    @endif

    <hr class="my-12">

    <a href="{{ route('services.index', $service->slug) }}" class="no-underline">&larr; Back to all services</a>

</x-cms::layouts.services>
