{{-- list-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="flex flex-wrap">
  {{-- Search input --}}
  <div class="flex-grow {{ isset($sortableBy) && $sortableBy->isNotEmpty() ? 'w-full lg:w-auto' : '' }}">
    @include('laravel-views::components.filters.search')
  </div>

  {{-- Sorting --}}
  @if (isset($sortableBy) && $sortableBy->isNotEmpty())
    <div class="flex-1 lg:ml-4">
      @include('laravel-views::components.filters.sorting')
    </div>
  @endif

  {{-- Filters --}}
  <div class="text-right {{ isset($sortableBy) && $sortableBy->isNotEmpty() ? '' : 'lg:flex-1 ml-4 lg:ml-0' }}">
    @include('laravel-views::components.filters.filters')
  </div>
</div>
