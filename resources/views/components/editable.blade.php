{{-- components.editable

Render an editable input field

--}}

<div
        x-data="{
            field: '{{ $field }}',
            id: {{ $model->id }},
            value: {{ json_encode($model->$field) }},
            original: {{ json_encode($model->$field) }},
            editing: false
        }"
        @click.away="editing = false; value = original;"
>
        <input
                x-cloak
                x-ref="input"
                x-show="editing"
                x-model="value"
                @keydown.enter="
                    $wire.update({
                    id: id,
                    value: value,
                    field: field
                }); editing = false;"
                @keydown.escape="editing = false; value = original;"
                class="bg-green-100 text-black-700 border border-green-200 rounded py-2 px-4 leading-tight outline-none w-full"
        >
    <div
            x-show="!editing"
            @click="editing = true; $nextTick(() => {$refs.input.focus();$refs.input.setSelectionRange(-1, -1);});"
            x-html="value"
            class='transition-all duration-300 ease-in-out inline-block cursor-pointer border-b-2 border-dotted border-gray-400 hover:bg-gray-100 p-1'>
        {!! $model->$field !!}
    </div>

</div>
