{{-- table-view.table-view

Base layout to render all the UI componentes related to the table view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.table
  - components.paginator --}}
<x-dynamic-component :component="$this->getComponent('layout')">
  {{-- Search input and filters --}}
  <div class="py-4 px-3 pb-0">
    <x-dynamic-component :component="$this->getComponent('toolbar')" />
  </div>

  @if (count($this->items))
    {{-- Content table --}}
    <div class="overflow-x-auto">
      <table class="min-w-full">

        <thead
          class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left"
        >
          <tr>
            @if ($this->hasBulkActions)
              <th class="pl-3">
                <span class="flex items-center justify-center">
                  <x-lv-checkbox wire:model="allSelected" />
                </span>
              </th>
            @endif
            {{-- Renders all the headers --}}
            @foreach ($this->headers as $header)
              <x-dynamic-component
                :component="$header->getComponent('table-header')"
                :header="$header"
                :sortBy="$this->sortBy"
                :sortOrder="$this->sortOrder"
              />
            @endforeach

            {{-- This is a empty cell just in case there are action rows --}}
            @if (count($this->actions) > 0)
              <th></th>
            @endif
          </tr>
        </thead>

        <tbody>
          @foreach ($this->items as $item)
            <tr
              class="border-b border-gray-200 text-sm"
              wire:key="{{ $item->getKey() }}"
            >
              @if ($this->hasBulkActions)
                <td class="pl-3">
                  <span class="flex items-center justify-center">
                    <x-lv-checkbox
                      value="{{ $item->getKey() }}"
                      wire:model="selected"
                    />
                  </span>
                </td>
              @endif
              {{-- Renders all the content cells --}}
              @foreach ($this->row($item) as $column)
                <td class="px-3 py-2 whitespace-no-wrap">
                  {!! $column !!}
                </td>
              @endforeach

              {{-- Renders all the actions row --}}
              @if (count($this->actions) > 0)
                <td>
                  <div class="px-3 py-2 flex justify-end">
                    <x-dynamic-component
                      :component="$this->getComponent('actions')"
                      :actions="$this->actions"
                      :model="$item"
                    />
                  </div>
                </td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h3>{{ __('There are no items in this table') }}</h3>
    </div>

  @endif

  {{-- Paginator, loading indicator and totals --}}
  <div class="p-4">
    {{ $this->items->links() }}
  </div>
</x-dynamic-component>