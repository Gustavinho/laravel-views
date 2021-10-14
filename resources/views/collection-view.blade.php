<div>
  <renderable :renderable="$this->component('alerts-handler')" />

  <div>
    @if ($this->component('header'))
      <renderable :renderable="$this->component('header')" class="mb-4" />
    @endif

    @include('laravel-views::toolbar')
  </div>
  <div class="overflow-x-auto">
    <renderable :renderable="$this->component('collection')" />
  </div>
  {{-- Paginator, loading indicator and totals --}}
  @if ($this->items instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    <div class="mt-8">
      {{ $this->items->links() }}
    </div>
  @endif

  @if ($this->component('footer'))
    <renderable :renderable="$this->component('footer')" class="mt-4" />
  @endif

  <renderable :renderable="$this->component('actions-confirmation')" />
</div>