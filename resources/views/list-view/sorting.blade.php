{{-- list-view.sorting.blade

Renders the dropdown for the sorting select
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/select --}}
<div class="leading-tight">
  {{-- Sorting dropdown --}}
  @if (isset($sortableBy) && $sortableBy->isNotEmpty())
    @component('laravel-views::components.drop-down')
      @slot('trigger')
        @include('laravel-views::components.buttons.select', [
        'title'=> $sortableBy->flip()->get($sortBy) ?? __('Sort By'),
        ])
      @endslot
      {{-- Each sortable item --}}
      <div class="p-2 text-sm">
        {{ __('Sort By') }}
      </div>
      @foreach ($sortableBy as $title => $column)
        <div class="hover:bg-gray-200">
          <a href="#!" wire:click.prevent="sort('{{ $column }}')" title="{{ $title }}">
            <div class="flex items-center px-2 py-2">
              <div class="w-4">
                @if ($sortBy === $column)
                  <i data-feather="arrow-{{ $sortOrder === 'asc' ? 'up' : 'down' }}" class="text-gray-900 h-4 w-4"></i>
                @else
                  <svg class="h-4 w-4"></svg>
                @endif
              </div>
              <div class="truncate ml-1">{{ $title }}</div>
            </div>
          </a>
        </div>
      @endforeach
    @endcomponent
  @endif
</div>
