<x-cms::layouts.app>

    <x-cms::page-header :header="$page->header" :heading="$page->title" />

    <div class="prose max-w-none">
        <h1>{{ $page->title }}</h1>
        @if( $page->content ?? null )
            {!! tiptap_converter()->asHTML($page->content) !!}
        @endif
    </div>
</x-cms::layouts.app>
