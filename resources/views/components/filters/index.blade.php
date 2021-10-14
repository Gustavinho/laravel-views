@php
$clearable = false;
@endphp
{{-- Filters dropdown --}}
<x-lv-dropdown label="Filters">
  {{-- Each filter view --}}
  @foreach ($this->filters as $filter)
    @php
      if ($this->{$filter->id} != $filter->defaultValue) {
          $clearable = true;
      }
    @endphp

    {{-- Filter title --}}
    <x-lv-dropdown.header :label="$filter->getTitle()" />
    <div class="px-4 mt-4">
      {{-- Filter view --}}
      <renderable :renderable="$filter"></renderable>
    </div>
  @endforeach
  @if ($clearable)
    {{-- Clear filters button --}}
    <div class="p-4 bg-gray-100 text-right flex justify-end">
      <button wire:click.prevent="clearFilters" @click="open = false"
        class="text-gray-600 flex items-center hover:text-gray-700 focus:outline-none text-sm">
        <i data-feather="x-circle" class="mr-2 w-5 h-5"></i>
        {{ __('Clear filters') }}
      </button>
    </div>
  @endif
</x-lv-dropdown>