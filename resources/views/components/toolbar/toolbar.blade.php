{{-- list-view.filters.blade

Renders the search input and the filters dropdown
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
UI components used:
  - form/input-group
  - dropdown --}}

<div class="md:flex items-center">
  {{-- Search input --}}
  <div class="flex-1">
    @include('laravel-views::components.toolbar.search')
  </div>

  {{-- Actions on the left --}}
  <div class="flex gap-2 flex-1 justify-end items-center mb-4">
    {{-- Bulk actions --}}
    @if (count($selected) > 0)
      <div>
        <x-lv-drop-down label='Actions'>
          <x-lv-drop-down.header label='{{ count($selected) }} Selected' />
          @foreach ($this->bulkActions as $action)
            <a href="#!" wire:click.prevent="executeBulkAction('{{ $action->id }}', true)" title="{{ $action->title}}" class="group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900" wire:loading.class.remove="hover:text-gray-900 text-gray-700" wire:loading.class='text-gray-400 hover:text-gray-400' wire:target="executeBulkAction">
              <i data-feather="{{ $action->icon }}" class="mr-3 h-4 w-4"></i>
              {{ $action->title }}
            </a>
          @endforeach
        </x-lv-drop-down>
      </div>
    @endif

    {{-- Sorting --}}
    @if (isset($sortableBy) && $sortableBy->isNotEmpty())
      <div>
        @include('laravel-views::components.toolbar.sorting')
      </div>
    @endif

    {{-- Filters --}}
    <div>
      @include('laravel-views::components.toolbar.filters')
    </div>
  </div>
</div>
