<div {{ $attributes->class(['grid']) }}>
  @forelse  ($this->items as $key => $item)

    <renderable :renderable="$this->component('item')" :item="$item">

      @if (!empty($this->bulkActions))
        <x-slot name="bulkCheckbox">
          <x-lv-form.checkbox wire:model="selected" value="{{ $key }}" />
        </x-slot>
      @endif

      @if (!empty($this->actions))
        <x-slot name="actions">
          <renderable :renderable="$this->component('actions-container')" :actions="$this->actions" :key="$key" />
        </x-slot>
      @endif

    </renderable>

  @empty
    {{-- No results message --}}
    <renderable :renderable="$this->component('no-results')" />
  @endforelse
</div>