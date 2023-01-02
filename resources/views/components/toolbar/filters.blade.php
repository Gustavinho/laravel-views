{{-- Filters dropdown --}}
@if (isset($filtersViews) && $filtersViews)
  <x-lv-drop-down label="Filters">
    {{-- Each filter view --}}
    @foreach ($filtersViews as $filter)
      {{-- Filter title --}}
      <x-lv-drop-down.header :label="$filter->getTitle()" />
      <div class="px-4 mt-4">
        {{-- Filter view --}}
        @include('laravel-views::components.filters.' . $filter->view, [
          'view' => $filter,
          'filter' => $filter,
        ])
      </div>
    @endforeach

    @if (count($filters) > 0)
      {{-- Clear filters button --}}
      <div class="px-4 py-2 bg-gray-100 text-right flex justify-end border-t border-gray-200">
        <button wire:click.prevent="clearFilters" @click="open = false" class="text-gray-600 flex items-center hover:text-gray-700 focus:outline-none text-sm">
          <i data-feather="slash" class="mr-2 w-4 h-4"></i>
          {{__('Clear filters')}}
        </button>
      </div>
    @endif
  </x-lv-drop-down>
@endif
