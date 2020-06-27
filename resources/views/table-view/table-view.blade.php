{{-- table-view.table-view

Base layout to render all the UI componentes related to the table view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.table
  - components.paginator --}}

<div>
  {{-- Search input and filters --}}
  <div class="p-4 pb-0">
    @include('laravel-views::table-view.filters')
  </div>

  {{-- Success feedback --}}
  @if (session()->has('message'))
    @component('laravel-views::components.alert', [
      'message' => session('message'),
      'onClose' => 'flushMessage',
      'type' => session('messageType')
    ])
    @endcomponent
  @endif

  @if (count($items))

    {{-- Content table --}}
    <div class="overflow-x-auto">
      @component('laravel-views::components.table', [
        'headers' => $headers,
        'actionsByRow' => $actionsByRow,
        'items' => $items,
        'view' => $view
      ])
      @endcomponent
    </div>

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h1>There are not items in this table</h1>
    </div>

  @endif

  {{-- Paginator, loading indicator and totals --}}
  <div class="p-4 flex items-center">
    <div class="flex-1">
      {{ $items->links('laravel-views::components.paginator') }}
    </div>
    <div class="flex items-center">
      <span wire:loading class="mr-4">
        Loading
      </span>
      <div>
        <b>Showing</b> {{ $total }} items
      </div>
    </div>
  </div>
</div>

