@if($media)

    @if( $curation && $media->hasCuration($curation) )
        <x-curator-curation :media="$media" :curation="$curation" :class="$imgClass" />
    @else
        @if( $preset )
            <x-curator-glider
                :class="$imgClass"
                :media="$media"
                :width="$preset->getWidth()"
                :height="$preset->getHeight()"
            />
        @else
            <img src="{{ $media->url }}" class="{{ $imgClass }}" />
        @endif
    @endif

@endif
