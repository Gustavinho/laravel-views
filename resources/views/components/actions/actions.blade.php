@props(['actions', 'model'])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    <div class="lg:hidden text-right relative">
      <x-lv-drop-down>
        <x-slot name="trigger">
          <x-lv-icon-button icon="more-horizontal" size="sm" />
        </x-slot>

        <x-lv-actions.icon-and-title :actions="$actions" :model="$model" />
      </x-lv-drop-down>
    </div>

    {{-- Desktop action buttons --}}
    <div class="hidden lg:flex justify-items-end">
        <x-lv-actions.icon :actions="$actions" :model="$model" />
    </div>
  @endif
</div>