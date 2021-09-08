<div>
  <renderable :renderable="$this->component('alerts-handler')" />

  <div>
    @if ($this->component('header'))
      <renderable :renderable="$this->component('header')" class="mb-4" />
    @endif

    @include('laravel-views::toolbar')
  </div>

  <renderable :renderable="$this->component('collection')" />

  {{-- Paginator, loading indicator and totals --}}
  @if ($this->items->hasPages())
    <div class="mt-8">
      {{ $this->items->links() }}
    </div>
  @endif

  @if ($this->component('footer'))
    <renderable :renderable="$this->component('footer')" class="mt-4" />
  @endif

  <renderable :renderable="$this->component('actions-confirmation')" />
</div>