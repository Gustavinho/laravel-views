@props(['actions', 'model'])

<x-lv-drop-down>
  <x-slot name="trigger">
    <x-lv-icon-button icon="more-horizontal" size="sm"/>
  </x-slot>

  <x-lv-actions.icon-and-title :actions="$actions" :model="$model" />
</x-lv-drop-down>