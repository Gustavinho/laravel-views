{{-- list-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}
@props(['showSelectAll' => true])
<div class="md:flex items-center">
  {{-- Search input --}}
  <div class="flex-1">
    <x-dynamic-component :component="$this->getComponent('toolbar-search')" />
  </div>

  {{-- Actions on the left --}}
  <div class="flex space-x-1 flex-1 justify-end items-center mb-4">
    {{-- Bulk actions --}}
    <div>
      <x-dynamic-component :component="$this->getComponent('actions-bulk')" :showSelectAll="$showSelectAll" />
    </div>

    {{-- Sorting --}}
    @if (isset($this->sortableBy) && $this->sortableBy->isNotEmpty())
      <div>
        <x-dynamic-component :component="$this->getComponent('toolbar-sorting')" />
      </div>
    @endif

    {{-- Filters --}}
    <div>
      <x-dynamic-component :component="$this->getComponent('toolbar-filters')" />
    </div>
  </div>
</div>