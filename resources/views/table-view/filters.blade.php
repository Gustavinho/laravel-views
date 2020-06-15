{{-- table-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="flex flex-row">
  {{-- Search input --}}
  @if ($searchBy)
    <div class="flex-1">
      @component('laravel-views::components.form.input-group', [
        'placeholder' => 'Search',
        'model' => 'search',
        'onClick' => 'clearSearch',
        'icon' => $search ? 'x-circle' : 'search'
      ])
      @endcomponent
    </div>
  @endif

  {{-- Filters dropdown --}}
  @if (isset($filtersViews) && $filtersViews)
    @component('laravel-views::components.drop-down', [
      'title' => "Filters " . (count($filters) ? "(" . count($filters) . ")" : ''),
    ])

      {{-- Each filter view --}}
      @foreach ($filtersViews as $filter)
        {{-- Filter title --}}
        <div class="border-b border-t border-gray-200 bg-gray-100 text-xs font-semibold uppercase text-left px-4 py-2 mb-4">
          {{ $filter->getTitle() }}
        </div>
        <div class="px-4">
          {{-- Filter view --}}
          @include('laravel-views::table-view.' . $filter->view, [
            'view' => $filter,
            'filter' => $filter,
          ])
        </div>
      @endforeach

      @if (count($filters) > 0)
        {{-- Clear filters button --}}
        <div class="p-4 bg-gray-100 text-right flex justify-end">
          <a wire:click="clearFilters" @click="open = false" href="#" class="text-gray-600 flex items-center hover:text-gray-700">
            <i data-feather="x-circle" class="mr-2 w-5 h-5"></i>
            Clear filters
          </a>
        </div>
      @endif
    @endcomponent
  @endif
</div>