{{-- list-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="md:flex items-center">
  {{-- Search input --}}
  <div class="flex-1">
    @include('laravel-views::components.toolbar.search')
  </div>

  {{-- Actions on the right --}}
  <div class="flex gap-2 flex-1 justify-end items-center mb-4 relative">
    {{-- Sorting --}}
    @if (isset($sortableBy) && $sortableBy->isNotEmpty())
      <div>
        @include('laravel-views::components.toolbar.sorting')
      </div>
    @endif

    {{-- Loading Spinner --}}
    <div class="absolute top-0 left-0 z-10" wire:loading >
      <div class="mx-3 my-1 animate-spin ease-linear rounded-full border-2 border-t-2 border-gray-200 h-7 w-7 pt-3" style="border-top-color: #222;"></div>
    </div>

    {{-- Filters --}}
    <div>
      @include('laravel-views::components.toolbar.filters')
    </div>
  </div>
</div>
