<div class="md:flex items-center">
  {{-- Search input --}}
  @if ($this->searchBy)
    <renderable :renderable="$this->component('search')" class="flex-1 mb-4" />
  @endif

  @if (!empty($this->bulkActions) || !empty($this->sortableBy) || !empty($this->filters))
    <div class="flex space-x-1 flex-1 mb-4 justify-end items-center">

      {{-- Bulk actions --}}
      @if (!empty($this->bulkActions))
        <renderable :renderable="$this->component('actions-container-bulk')" :bulkActions="$this->bulkActions" />
      @endif

      {{-- Sorting --}}
      @if (!empty($this->sortableBy))
        <renderable :renderable="$this->component('sorting')" />
      @endif

      {{-- Filters --}}
      @if (!empty($this->filters))
        <renderable :renderable="$this->component('filters')" />
      @endif
    </div>
  @endif
</div>