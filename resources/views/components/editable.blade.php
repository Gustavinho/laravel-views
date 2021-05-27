{{-- components.editable

Render an editable text field

--}}

<div
        @click.away="away()"
        x-data="{
    editor:false,
    editing:false,
    field: '{{ $field }}',
    type: '{{ $type }}',
    id: {{ $model->id }},
    value: {{ json_encode($model->$field) }},
    original: {{ json_encode($model->$field) }},
    away()
    {

if(this.type === 'input') {
    this.editing = false;
    this.value = this.original
}

if(this.type === 'html') {

    }
    },
    update()
    {
    $wire.update({
            id: this.id,
            value: this.value,
            field: this.field
        })
    },
     edit($dispatch) {

if(this.type === 'input') {
this.$refs.input.focus();
this.$refs.input.setSelectionRange(-1, -1);
}

if(this.type === 'html') {
ClassicEditor
 .create(this.$refs.editor, {
                            toolbar: ['bold', 'italic', 'link'],
                            fillEmptyBlocks: false
                        })
                       .then(function (editor) {
                            editor.model.document.on('change:data', () => {
                                $dispatch('input', editor.getData())
                            })
                        })
                                        .catch( error => {
                  console.error( error );
                } );

       }
}
     }"
>
    @if($type === 'input')
        <input
                x-cloak
                x-ref="input"
                x-show="editing"
                x-model="value"
                @keydown.enter="update()"
                @keydown.escape="editing = false; value = original"
                class="bg-green-100 text-black-700 border border-green-200 rounded py-2 px-4 leading-tight outline-none w-full"
        >
    @endif

    @if($type === 'html')
        <div x-ref="editor"
             @input="console.log($event);"
             x-cloak
             x-show="editing"
        >
            {!! $model->$field !!}
        </div>
        <button
                x-cloak
                x-show="editing"
                class="my-1 py-1 px-2 flex bg-gray-300 focus:outline-none active:outline-none hover:bg-gray-600 hover:text-gray-100 focus:text-gray-100 active:text-gray-100 focus:bg-gray-600 active:bg-gray-600 transition-all duration-300 ease-in-out"
                @click="update">{{ __('Save') }}</button>
    @endif

    <span
            @click="editing = true; $nextTick(() => {edit($dispatch)});"
            x-show="!editing"
            class='cursor-pointer border-b-2 border-gray-400 border-dotted'>{!! $model->$field !!}</span>

</div>
