<x-app-layout>

    <x-page-header :header="$page->header" :title="$page->title" />

    <div class="prose max-w-none">
        <h1>{{ $page->title }}</h1>
        @if( $page->content ?? null )
            {!! tiptap_converter()->asHTML($page->content) !!}
        @endif
    </div>

    @if( $page->blocks )
        <div class="mt-20">
            @foreach($page->blocks ?? [] as $block)
                <div class="py-12">
                    @livewire($block['type'], ['blockData' => $block['data']])
                </div>
{{--                <x-cms::content-blocks.wrapper--}}
{{--                    :style="$block['data']['block_style'] ?? 'default'"--}}
{{--                    :width="$block['data']['block_width'] ?? 'default'"--}}
{{--                >--}}
{{--                    @livewire($block['type'], ['blockData' => $block['data']])--}}
{{--                </x-cms::content-blocks.wrapper>--}}
            @endforeach
        </div>
    @endif
</x-app-layout>
