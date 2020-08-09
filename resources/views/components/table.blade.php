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
      {{-- Renders all the headers --}}
      @foreach ($headers as $header)
        <th class="px-3 py-3">
          {{ $header }}
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
      <tr class="border-b border-gray-200 text-sm">

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
              @foreach ($actionsByRow as $action)
                {{-- This renderIf method is implemented in every action --}}
                @if ($action->renderIf($item))
                  <a href="#" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $item->id }}')">
                    <i data-feather="{{ $action->icon }}" class="mr-2 text-gray-400 hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600"></i>
                  </a>
                @endif
              @endforeach
            </div>
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
