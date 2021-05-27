{{-- list-view.sorting.blade

Renders the dropdown for the sorting select
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/select --}}
<div class="leading-tight">
  {{-- Sorting dropdown --}}
  <x-lv-drop-down>
    <x-slot name="trigger">
      <x-laravel-views::buttons.select>
        <x-slot name="title">
          {{ __('Sort By') }}@if ($sortableByName = $sortableBy->flip()->get($sortBy)): <i
              data-feather="arrow-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"
              class="inline-block align-bottom text-gray-900 h-4 w-4"></i> {{ $sortableByName }}@endif
        </x-slot>
      </x-laravel-views::buttons.select>
    </x-slot>
    {{-- Each sortable item --}}
    <div class="p-2 text-sm">
      {{ __('Sort By') }}
    </div>
    @foreach ($sortableBy as $title => $column)
      <a href="#!"
        wire:click.prevent="sort('{{ $column }}')"
        title="{{ __('Sort by') }} {{ $title }} {{ __($sortOrder == 'asc' ? 'descending' : 'ascending') }}"
        class="group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
        @if ($sortBy === $column)
          <i data-feather="arrow-{{ $sortOrder === 'asc' ? 'up' : 'down' }}"
            class="text-gray-900 h-4 w-4"></i>
        @else
          <i class="text-gray-900 h-4 w-4"></i>
        @endif
        <div class="truncate ml-1">{{ $title }}</div>
      </a>
    @endforeach
  </x-lv-drop-down>
</div>
