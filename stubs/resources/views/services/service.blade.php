<x-services-layout>

    <x-page-header :header="$service->header" :title="$service->title" />

    <div class="prose max-w-none">
        <h1 class="mb-2">{{ $service->title }}</h1>
        @if( $service->service_category_id )
            <p class="text-sm">
                <a href="{{ route('services.category', $service->service_category->slug) }}">
                    {{ $service->service_category->title }}
                </a>
            </p>
        @endif
        @if( $service->content ?? null )
            {!! tiptap_converter()->asHTML($service->content) !!}
        @endif
        <hr>
        <a href="{{ route('services.index', $service->slug) }}" class="no-underline">&larr; Back to all services</a>
    </div>
</x-services-layout>
