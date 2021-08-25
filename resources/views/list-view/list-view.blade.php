<div>
  <div class="px-4">
    @if ($this->header)
      <div class="mb-4">
        {!! $this->header !!}
      </div>
    @endif

    {{-- Search input and filters --}}
    <x-dynamic-component :component="$this->component('toolbar')" />
  </div>

  <div>
    @foreach ($this->items as $item)
      <div class="flex items-center border-b border-gray-200 ">
        @if ($this->hasBulkActions)
          <div class="h-full flex items-center pl-3 md:pl-4">
            <x-dynamic-component :component="$this->component('checkbox')" wire:model="selected"
              value="{{ $item->getKey() }}" />
          </div>
        @endif
        <div class="flex-1 py-2 px-3 md:px-4">
          {!! $this->getItemComponent($item, 'listItem')->render() !!}
        </div>
        <x-dynamic-component :component="$this->component('actions-container')" :actions="$this->actions"
          :model="$item" />
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8 px-4">
    {{ $this->items->links() }}
  </div>
</div>