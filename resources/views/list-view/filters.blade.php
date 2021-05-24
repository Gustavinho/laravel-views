{{-- list-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="grid grid-cols-12 gap-x-4">
  {{-- Search input --}}
  <div class="col-span-12 sm:col-span-8">
    @include('laravel-views::components.filters.search')
  </div>

  <div class="col-span-12 sm:col-span-4">
    <div class="flex">
      {{-- Sorting --}}
      <div class="flex-grow min-w-0">
        @include('laravel-views::list-view.sorting')
      </div>

      {{-- Filters --}}
      @include('laravel-views::components.filters.filters')
    </div>
  </div>
</div>
