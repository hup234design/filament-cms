@props(['record'])

@section('header')
    <div class="min-h-40 bg-black flex flex-col items-center justify-center">
        <div class="max-w-screen-2xl mx-auto text-center space-y-4">
            @if($record->header->heading)
                <p class="text-4xl font-bold text-white">
                    {{ $record->header->heading }}
                </p>
                @if( $record->header->subheading )
                    <p class="text-xl font-semibold text-white">
                        {{ $record->header->subheading }}
                    </p>
                @endif
            @else
                <p class="text-4xl font-bold text-white">
                    {{ $record->title }}
                </p>
            @endif
        </div>
    </div>
@endsection
