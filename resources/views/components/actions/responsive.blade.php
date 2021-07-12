@props(['actions' => [], 'model' => null])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    <div class="lg:hidden text-right relative">
      <x-lv-actions.drop-down :actions="$actions" :model="$model" />
    </div>

    {{-- Desktop action buttons --}}
    <div class="hidden lg:flex justify-items-end">
        <x-lv-actions.icon :actions="$actions" :model="$model" />
    </div>
  @endif
</div>