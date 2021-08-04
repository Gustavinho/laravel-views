<x-dynamic-component :component="$this->getComponent('layout')">
  {{-- Search input and filters --}}
  <div class="px-4">
    <x-dynamic-component :component="$this->getComponent('toolbar')"/>
  </div>

  <div>
    @foreach ($this->items as $item)
      <div class="flex items-center border-b border-gray-200 ">
        @if ($this->hasBulkActions)
          <div class="h-full flex items-center pl-3 md:pl-4">
              <x-dynamic-component :component="$this->getComponent('checkbox')" wire:model="selected" value="{{ $item->getKey() }}"/>
          </div>
        @endif
        <div class="py-2 px-3 md:px-4 flex-1">
            {!! $this->getItemComponent($item, 'card')->render() !!}
        </div>
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8 px-4">
    {{ $this->items->links() }}
  </div>
</x-dynamic-component>
