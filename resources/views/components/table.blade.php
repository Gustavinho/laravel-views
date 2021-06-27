{{-- components.table

Renders a data table
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props:
  - headers
  - itmes
  - actionsByRow --}}

<table class="min-w-full">

  <thead class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
    <tr>
      @if ($this->hasBulkActions)
        <th class="pl-3">
          <span class="flex items-center justify-center">
            <x-lv-checkbox wire:model="allSelected" />
          </span>
        </th>
      @endif
      {{-- Renders all the headers --}}
      @foreach ($headers as $header)
        <th class="px-3 py-3" {{ is_object($header) && ! empty($header->width) ? 'width=' . $header->width . '' : '' }}>
          @if (is_string($header))
            {{ $header }}
          @else
            @if ($header->isSortable())
              <div class="flex">
                <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex-1">
                  {{ $header->title }}
                </a>
                <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex">
                  <i data-feather="chevron-up" class="{{ $sortBy === $header->sortBy && $sortOrder === 'asc' ? 'text-gray-900' : 'text-gray-400'}} h-4 w-4"></i>
                  <i data-feather="chevron-down" class="{{ $sortBy === $header->sortBy && $sortOrder === 'desc' ? 'text-gray-900' : 'text-gray-400'}} h-4 w-4"></i>
                </a>
              </div>
            @else
              {{ $header->title }}
            @endif
          @endif
        </th>
      @endforeach

      {{-- This is a empty cell just in case there are action rows --}}
      @if (count($actionsByRow) > 0)
        <th></th>
      @endif
    </tr>
  </thead>

  <tbody>
    @foreach ($items as $item)
      <tr class="border-b border-gray-200 text-sm" wire:key="{{ $item->getKey() }}">
        @if ($this->hasBulkActions)
          <td class="pl-3">
            <span class="flex items-center justify-center">
              <x-lv-checkbox value="{{ $item->getKey() }}" wire:model="selected" />
            </span>
          </td>
        @endif
        {{-- Renders all the content cells --}}
        @foreach ($view->row($item) as $column)
          <td class="px-3 py-2 whitespace-no-wrap">
            {!! $column !!}
          </td>
        @endforeach

        {{-- Renders all the actions row --}}
        @if (count($actionsByRow) > 0)
          <td>
            <div class="px-3 py-2 flex justify-end">
              <x-lv-actions :actions="$actionsByRow" :model="$item" />
            </div>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
