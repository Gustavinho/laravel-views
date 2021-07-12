{{-- table-view.date.blade

Renders a datepicker input
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/input
props:
 - $label
 - $name
 - $placeholder
 - $value
 - $model
 - $id
--}}

<x-lv-input
  :value="$value"
  :id="$id"
  wire:model="{{ $model }}"
  x-data="{ picker: null }"
  x-ref="{{ $id }}"
  x-init="picker = new Pikaday({ field: $refs['{{ $id }}'], format: 'YYYY-MM-DD', onSelect: () => $dispatch('input', picker.toString('YYYY-MM-DD')) })"
>
</x-lv-input>