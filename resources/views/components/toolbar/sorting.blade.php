{{-- list-view.sorting.blade

Renders the dropdown for the sorting select
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/select --}}
<div class="leading-tight">
  {{-- Sorting dropdown --}}
  <x-lv-drop-down>
    <x-slot name="trigger">
      <x-lv-select-button>
        {{ __('Sort By') }}@if ($sortableByName = $sortableBy->flip()->get($sortBy)):
          {{-- <i data-feather="arrow-{{ $sortOrder === 'asc' ? 'up' : 'down' }}" class="h-4 w-4"></i> --}}
          {{ $sortableByName }}
        @endif
      </x-lv-select-button>
    </x-slot>

    <x-lv-drop-down.header label="{{ __('Sort by') }}" />

    {{-- Each sortable item --}}
    @foreach ($sortableBy as $title => $column)
      <a href="#!"
        wire:click.prevent="sort('{{ $column }}')"
        title="{{ __('Sort by') }} {{ $title }} {{ __($sortOrder == 'asc' ? 'descending' : 'ascending') }}"
        class="group flex items-center px-4 py-2 hover:bg-gray-100 hover:text-gray-900 text-sm gap-3"
      >
        @if ($sortBy === $column)
          <i data-feather="arrow-{{ $sortOrder === 'asc' ? 'up' : 'down' }}" class="text-gray-900 h-4 w-4"></i>
        @else
          <i class="text-gray-900 h-4 w-4"></i>
        @endif
        {{ $title }}
      </a>
    @endforeach
  </x-lv-drop-down>
</div>
