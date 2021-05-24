{{-- table-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="flex flex-row">
  {{-- Search input --}}
  @include('laravel-views::components.filters.search')

  {{-- Filters --}}
  <div class="lg:flex-1 ml-4 lg:ml-0 text-right">
    @include('laravel-views::components.filters.filters')
  </div>
</div>
