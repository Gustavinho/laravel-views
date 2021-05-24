{{-- Filters dropdown --}}
@if (isset($filtersViews) && $filtersViews)
  @component('laravel-views::components.drop-down', ['dropDownClasses' => 'w-64'])
    @slot('trigger')
      <x-lv-icon-button icon="filter" />
    @endslot
    {{-- Each filter view --}}
    @foreach ($filtersViews as $filter)
      {{-- Filter title --}}
      <div class="border-b border-t border-gray-200 bg-gray-100 text-xs font-semibold uppercase text-left px-4 py-2 mb-4">
        {{ $filter->getTitle() }}
      </div>
      <div class="px-4">
        {{-- Filter view --}}
        @include('laravel-views::components.filters.' . $filter->view, [
        'view' => $filter,
        'filter' => $filter,
        ])
      </div>
    @endforeach

    @if (count($filters) > 0)
      {{-- Clear filters button --}}
      <div class="p-4 bg-gray-100 text-right flex justify-end">
        <a wire:click="clearFilters" @click="open = false" href="#"
          class="text-gray-600 flex items-center hover:text-gray-700">
          <i data-feather="x-circle" class="mr-2 w-5 h-5"></i>
          Clear filters
        </a>
      </div>
    @endif
  @endcomponent
@endif
