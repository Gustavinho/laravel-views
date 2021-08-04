{{-- table-view.table-view

Base layout to render all the UI componentes related to the table view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.table
  - components.paginator --}}
<x-dynamic-component :component="$this->getComponent('layout')">
  {{-- Search input and filters --}}
  <div class="py-4 px-3 pb-0">
    <x-dynamic-component :component="$this->getComponent('toolbar')"/>
  </div>

  @if (count($this->items))
    {{-- Content table --}}
    <div class="overflow-x-auto">
      <x-dynamic-component :component="$this->getComponent('table')" :headers="$this->headers" :items="$this->items" :hasBulkActions="$this->hasBulkActions" :actions="$this->actions" :sortBy="$this->sortBy" :sortOrder="$this->sortOrder"/>
    </div>

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h3>{{ __('There are no items in this table') }}</h3>
    </div>

  @endif

  {{-- Paginator, loading indicator and totals --}}
  <div class="p-4">
    {{ $this->items->links() }}
  </div>
</x-dynamic-component>

