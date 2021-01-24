<div>
  {{-- Search input and filters --}}
  <div class="px-4 lg:px-0">
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
      <div class="border-b border-gray-200 py-2 px-4 lg:px-0">
        <x-lv::dynamic-component :view="$itemComponent" :data="$this->data($item)" />
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8 px-4 lg:px-0">
    {{ $items->links() }}
  </div>
</div>