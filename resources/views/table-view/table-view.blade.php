{{-- table-view.table-view

Base layout to render all the UI componentes related to the table view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.table
  - components.paginator --}}

<div class="min-h-screen">
  {{-- Search input and filters --}}
  <div class="py-4 px-3 pb-0">
    @include('laravel-views::table-view.filters')
  </div>

  {{-- Success/Error feedback --}}
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
        'view' => $view,
        'sortBy' => $sortBy,
        'sortOrder' => $sortOrder
      ])
      @endcomponent
    </div>

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h1>There are no items in this table</h1>
    </div>

  @endif

  {{-- Paginator, loading indicator and totals --}}
  <div class="p-4">
    {{ $items->links() }}
  </div>

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</div>

