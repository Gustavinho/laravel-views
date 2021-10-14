@props(['actions', 'key' => null, 'desktop' => true, 'mobile' => true])

<div {{ $attributes }}>
  {{-- Mobile actions dropdown --}}
  @if ($mobile)
    <x-lv-dropdown class="{{ $desktop ? 'lg:hidden' : '' }}">
      <x-slot name="trigger">
        <x-lv-buttons.icon icon="more-horizontal" size="sm" />
      </x-slot>
      @foreach ($actions as $action)
        <renderable :renderable="$action" :key="$key" variant="mobile" />
      @endforeach
    </x-lv-dropdown>
  @endif

  {{-- Desktop action buttons --}}
  @if ($desktop)
    <div class="{{ 'lg:flex justify-items-end ' . ($mobile ? 'hidden' : '') }}">
      @foreach ($actions as $action)
        <renderable :renderable="$action" :key="$key" />
      @endforeach
    </div>
  @endif
</div>