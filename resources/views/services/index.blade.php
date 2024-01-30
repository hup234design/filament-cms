<x-cms::layouts.services>

    <x-cms::page-header title="Services" />

    <div class="mt-12 space-y-12">
        @foreach( $services as $service )
            <div class="prose max-w-none">
                <h2 class="mb-2">{{ $service->title }}</h2>
                @if( $service->service_category_id )
                    <p class="text-sm">
                        <a href="{{ route('services.category', $service->service_category->slug) }}">
                            {{ $service->service_category->title }}
                        </a>
                    </p>
                @endif
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

</x-cms::layouts.services>
