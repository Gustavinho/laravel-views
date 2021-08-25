<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />
  <div class="mb-2">
    <div class="mb-4">
      {!! $this->header !!}
    </div>

    {{-- Search input and filters --}}
    <x-dynamic-component :component="$this->component('toolbar')" />
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-{{ $maxCols }} gap-8 md:gap-8">
    @foreach ($this->items as $item)
      <div class="relative">
        @if ($this->bulkActions)
          <div class="absolute top-0 left-0 p-2">
            <x-dynamic-component :component="$this->component('checkbox')" wire:model="selected"
              value="{{ $item->getKey() }}" />
          </div>
        @endif
        {!! $this->getItemComponent($item, 'card')->render() !!}
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8">
    {{ $this->items->links() }}
  </div>
  <x-dynamic-component :component="$this->component('confirmation-message')" />
</div>