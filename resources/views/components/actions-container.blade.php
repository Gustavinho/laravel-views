@props(['actions' => [], 'model' => null, 'desktop' => true, 'mobile' => true])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    @if ($mobile)
      <div class="{{ 'text-right relative ' . ($desktop ? 'lg:hidden' : '') }}">
        <x-dynamic-component :component="$this->component('dropdown')">
          <x-slot name="trigger">
            <x-lv-icon-button icon="more-horizontal" size="sm" />
          </x-slot>
          @foreach ($actions as $action)
            <x-renderable :renderable="$action" :model="$model" variant="mobile" />
          @endforeach
        </x-dynamic-component>
      </div>
    @endif

    {{-- Desktop action buttons --}}
    @if ($desktop)
      <div class="{{ 'lg:flex justify-items-end ' . ($mobile ? 'hidden' : '') }}">
        @foreach ($actions as $action)
          <x-renderable :renderable="$action" :model="$model" />
        @endforeach
      </div>
    @endif
  @endif
</div>