<div {{ $attributes }}>
  @forelse  ($this->items as $item)
    <div @if (method_exists($this, 'itemOnClick')) wire:click="itemOnClick" @endif>

      <renderable :renderable="$this->component('item')" :item="$item">

        @if (!empty($this->bulkActions))
          <x-slot name="bulkCheckbox">
            <x-lv-checkbox wire:model="selected" value="{{ $item->getKey() }}" />
          </x-slot>
        @endif

        @if (!empty($this->actions))
          <x-slot name="actions">
            <renderable :renderable="$this->component('actions-container')" :actions="$this->actions" :model="$item" />
          </x-slot>
        @endif

      </renderable>

    </div>
  @empty
    <div class="flex justify-center items-center p-4">
      <h3>{{ __('It looks like there are no results') }}</h3>
    </div>
  @endforelse
</div>