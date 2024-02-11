@props(['blocks' => []])

@if( count($blocks) > 0 )
    @section('blocks')
        <div class="mt-24">
            @php
            $previous_style = null;
            @endphp
            @foreach($blocks ?? [] as $block)
                <div @class([
                    "lg:container" => ($block['data']['block_boxed'] ?? null)
                ])>
                <div @class([
                    "pb-24",
                    "pt-8" => ($block['data']['block_style'] ?? null) == $previous_style,
                    "pt-24" => ($block['data']['block_style'] ?? null) != $previous_style,
                    "bg-gray-200" => ($block['data']['block_style'] ?? null) == 'light',
                    "bg-gray-800" => ($block['data']['block_style'] ?? null) == 'dark',
                ])>
                    @if($block['data']['include_header'] ?? false)
                        <div class="container mb-16">
                        <div @class([
                            "prose max-w-none",
                            'prose-invert' => ($block['data']['block_style'] ?? null) == 'dark',
                            "text-center" => ($block['data']['header_alignment'] ?? 'center') == 'center'
                        ])>
                            <h2 class="text-4xl font-bold">
                                {{ $block['data']['header_title'] }}
                            </h2>
                            @if(trim($block['data']['header_text'] ?? ""))
                                <div @class([
                                    "max-w-4xl mx-auto" => ($block['data']['header_alignment'] ?? 'center') == 'center'
                                ])>
                                    <p class="text-xl font-medium">
                                        {!! nl2br($block['data']['header_text']) !!}
                                    </p>
                                </div>
                            @endif
                        </div>
                        </div>
                    @endif
                    <div class="container">
{{--                        <p>{{ json_encode($block['data']['block_style']) }}</p>--}}
                        @livewire($block['type'], ['blockData' => $block['data']])
                    </div>

                </div>
                </div>

                @php
                $previous_style = $block['data']['block_style'] ?? null;
                @endphp
            @endforeach
            {{--                <x-cms::content-blocks.wrapper--}}
            {{--                    :style="$block['data']['block_style'] ?? 'default'"--}}
            {{--                    :width="$block['data']['block_width'] ?? 'default'"--}}
            {{--                >--}}
            {{--                    @livewire($block['type'], ['blockData' => $block['data']])--}}
            {{--                </x-cms::content-blocks.wrapper>--}}
        </div>
    @endsection
@endif
