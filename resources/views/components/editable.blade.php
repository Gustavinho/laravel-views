{{-- components.editable

Render an editable text field

--}}

<div
        @click.away="editing = false; $refs.input.value = original"
        x-data="{
    editing:false,
    field: '{{ $field }}',
    id: {{ $model->id }},
    original: {{ json_encode($model->$field) }}
     }"
>
  <input
          x-cloak
          x-ref="input"
          x-show="editing"
          value="{!! $model->$field !!}"

          @keydown.enter="
          $wire.update({
            id: id,
            value: $refs.input.value,
            field: field
        })"

          @keydown.escape="editing = false; $refs.input.value = original"
          class="bg-green-100 text-black-700 border border-green-200 rounded py-2 px-4 leading-tight outline-none w-full"
  >
  <span
          @click="editing = true; $nextTick(() => {$refs.input.focus(); $refs.input.setSelectionRange(-1, -1);});"
          x-show="!editing"
          class='cursor-pointer border-b-2 border-gray-400 border-dotted'>{!! $model->$field !!}</span>

</div>
