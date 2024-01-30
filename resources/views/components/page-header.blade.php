@props(['header' => null, 'title' => null, 'subtitle' => null])

@section('header')
    <div class="min-h-40 bg-black flex flex-col items-center justify-center">
        <div class="max-w-screen-2xl mx-auto text-center space-y-4">
            @if($header?->heading)
                <p class="text-4xl font-bold text-white">
                    {{ $header->heading }}
                </p>
                @if( $header->subheading )
                    <p class="text-xl font-semibold text-white">
                        {{ $header->subheading }}
                    </p>
                @endif
            @else
                <p class="text-4xl font-bold text-white">
                    {{ $title }}
                </p>
                @if( $subtitle )
                    <p class="text-xl font-semibold text-white">
                        {{ $subtitle }}
                    </p>
                @endif
            @endif
        </div>
    </div>
@endsection
