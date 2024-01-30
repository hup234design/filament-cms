@php
$media    = $getMedia();
$curation = $useCuration();
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{}" class="break-words text-sm"
    >
        @if ($curation)
            <x-curator-curation :media="$media['id']" :curation="$curation" class="mx-auto"/>
        @else
            <x-curator-glider
                class="w-full"
                :media="$media['id']"
            />
        @endif
    </div>
</x-dynamic-component>
