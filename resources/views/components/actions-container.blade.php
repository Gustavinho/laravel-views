@props(['actions', 'model' => null, 'desktop' => true, 'mobile' => true])

<div {{ $attributes }}>
  {{-- Mobile actions dropdown --}}
  @if ($mobile)
    <div class="{{ 'text-right relative ' . ($desktop ? 'lg:hidden' : '') }}">
      <renderable :renderable="$this->component('dropdown')">
        <x-slot name="trigger">
          <x-lv-icon-button icon="more-horizontal" size="sm" />
        </x-slot>
        @foreach ($actions as $action)
          <renderable :renderable="$action" :model="$model" variant="mobile" />
        @endforeach
      </renderable>
    </div>
  @endif

  {{-- Desktop action buttons --}}
  @if ($desktop)
    <div class="{{ 'lg:flex justify-items-end ' . ($mobile ? 'hidden' : '') }}">
      @foreach ($actions as $action)
        <renderable :renderable="$action" :model="$model" />
      @endforeach
    </div>
  @endif
</div>