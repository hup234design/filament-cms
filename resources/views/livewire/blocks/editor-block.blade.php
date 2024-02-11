<div>
{{--    {{ json_encode($blockData) }}--}}
    <div @class([
        "prose max-w-none",
        'prose-invert' => ($blockData['block_style'] ?? null) == 'dark',
    ])>
        {!! tiptap_converter()->asHTML($blockData['content']) !!}
    </div>
</div>
