<div class="min-w-full shadow-md sm:rounded-lg bg-white relative">

  {{-- Search input and filters --}}
  <div class="p-4 pb-0">
    @include('laravel-views::filters')
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
    @component('laravel-views::components.table', [
      'headers' => $headers,
      'actionsByRow' => $actionsByRow,
      'items' => $items,
      'view' => $view
    ])
    @endcomponent

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h1>There are no items in this table</h1>
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
