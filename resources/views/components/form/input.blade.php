{{-- table-view.select.blade

Renders an input component
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

props:
 - $label
 - $name
 - $placeholder
 - $value
 - $model
 - $id
 - $attributes
--}}
@props(['label' => null])
<div class="text-left mb-4">
  @if ($label)
    <label class="block">
      {{ $label ?? '' }}
    </label>
  @endif

  <input
    {{ $attributes }}
    class="block appearance-none w-full bg-white border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-600 focus:border-2 border"
    type="text"
    autocomplete="off"
  >
</div>