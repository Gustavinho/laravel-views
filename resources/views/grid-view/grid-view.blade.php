{{-- grid-view.grid-view

Base layout to render all the UI componentes related to the grid view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

--}}

<x-lv-layout>
  {{-- Search input and filters --}}
  <div class="mb-2">
    @include('laravel-views::components.toolbar.toolbar')
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-{{ $maxCols }} gap-8 md:gap-8">
    @foreach ($items as $item)
      <div class="relative">
        @if ($this->hasBulkActions)
          <div class="absolute top-0 lef-0 p-2">
            <x-lv-checkbox wire:model="selected" value="{{ $item->getKey() }}"/>
          </div>
        @endif
        <x-lv-dynamic-component
          :view="$cardComponent"
          :data="array_merge($this->card($item), [
              'withBackground' => $withBackground,
              'model' => $item,
              'actions' => $actionsByRow,
              'hasDefaultAction' => $this->hasDefaultAction,
              'selected' => in_array($item->getKey(), $selected)
            ])"
        />
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8">
    {{ $items->links() }}
  </div>
</x-lv-layout>
