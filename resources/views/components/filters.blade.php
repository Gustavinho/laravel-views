{{-- Filters dropdown --}}
@php
$filters = $this->filters;
@endphp
<x-dynamic-component :component="$this->component('dropdown')" label="Filters">
  {{-- Each filter view --}}
  @foreach ($this->filters as $filter)

    {{-- Filter title --}}
    <x-dynamic-component :component="$this->component('dropdown-header')" :label="$filter->getTitle()" />
    <div class="px-4 mt-4">
      {{-- Filter view --}}
      <x-renderable :renderable="$filter"></x-renderable>
    </div>
  @endforeach

  @if (count($this->filter) > 0)
    {{-- Clear filters button --}}
    <div class="p-4 bg-gray-100 text-right flex justify-end">
      <button wire:click.prevent="clearFilters" @click="open = false"
        class="text-gray-600 flex items-center hover:text-gray-700 focus:outline-none text-sm">
        <i data-feather="x-circle" class="mr-2 w-5 h-5"></i>
        {{ __('Clear filters') }}
      </button>
    </div>
  @endif
</x-dynamic-component>