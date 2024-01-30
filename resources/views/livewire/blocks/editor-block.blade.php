<div>
{{--    {{ json_encode($blockData) }}--}}
    <div class="prose max-w-none">
        <h2>Editor Block</h2>
        {!! tiptap_converter()->asHTML($blockData['content']) !!}
    </div>
</div>
