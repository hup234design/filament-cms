<x-app-layout>

    <x-page-header :header="$page->header" :title="$page->title" />

    <div class="prose max-w-none">
        <h1>{{ $page->title }}</h1>
        @if( $page->content ?? null )
            {!! tiptap_converter()->asHTML($page->content) !!}
        @endif
    </div>
</x-app-layout>
