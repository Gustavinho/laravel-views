{{-- components.table.table

Renders a data table
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props:
  - headers
  - items
  - actionsByRow --}}

<table class="min-w-full">
  @include('laravel-views::components.table.header')

  <tbody>
    @foreach ($items as $item)
      <tr class="border-b border-gray-200 text-sm"
        wire:key="{{ $item->getKey() }}">
        @if ($this->hasBulkActions)
          <td class="pl-3">
            <span class="flex items-center justify-center">
              <x-lv-checkbox value="{{ $item->getKey() }}"
                wire:model="selected" />
            </span>
          </td>
        @endif
        {{-- Renders all the content cells --}}
        @foreach ($view->row($item) as $cell)
          <td @php
            $classNames = 'px-3 py-3 whitespace-no-wrap';
            
            // Here we access the corresponding header object to check if cell should be visible
            $header = $headers[$loop->index];
            if (is_object($header) && !empty($header->visibleBreakpoint)) {
                $classNames .= ' ' . $header->getResponsiveClassNames();
            }
            
            if (is_object($cell) && !empty($cell->classNames)) {
                $classNames .= ' ' . $cell->classNames;
            }
          @endphp
            class="{{ $classNames }}">
            @if (!$cell instanceof LaravelViews\UI\Cell)
              {!! $cell !!}
            @else
              {!! $cell->content !!}
            @endif
          </td>
        @endforeach

        {{-- Renders all the actions row --}}
        @if (count($actionsByRow) > 0)
          <td>
            <div class="px-3 py-2 flex justify-end">
              <x-lv-actions :actions="$actionsByRow"
                :model="$item" />
            </div>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
