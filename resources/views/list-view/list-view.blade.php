<div class="min-h-screen">
  {{-- Search input and filters --}}
  <div class="px-4">
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

  <div>
    @foreach ($items as $item)
      <div class="border-b border-gray-200 py-2 px-4">
        <x-lv-dynamic-component :view="$itemComponent" :data="array_merge($this->data($item), ['actions' => $actionsByRow, 'model' => $item])" />
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8 px-4">
    {{ $items->links() }}
  </div>

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</div>
