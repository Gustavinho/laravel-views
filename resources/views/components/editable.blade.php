{{-- components.editable

Render an editable input field --}}
@props(['model', 'field' => ''])

<div x-data="{
    field: '{{ $field }}',
    id: {{ $model->id }},
    value: {{ json_encode(strip_tags($model->$field)) }},
    original: {{ json_encode(strip_tags($model->$field)) }},
    editing: false
  }"
  @click.away="editing = false; value = original;">
  <input
    x-cloak
    x-ref="input"
    x-show="editing"
    x-model="value"
    @keydown.enter="$wire.update(id, {
      [field]: value
    }); editing = false; original = value"
    @keydown.escape="editing = false; value = original;"
    class="block appearance-none w-full bg-white border-gray-300 hover:border-gray-500 px-2 py-1 rounded focus:outline-none focus:bg-white focus:border-blue-600 focus:border-2 border">
  <div x-show="!editing"
    @click="editing = true; $nextTick(() => {$refs.input.focus()})"
    x-html="value"
    class='transition-all duration-300 ease-in-out px-2 py-1 rounded cursor-pointer focus:outline-none hover:bg-white hover:border-gray-500 border border-transparent'>
    {!! strip_tags($model->$field) !!}
  </div>

</div>
