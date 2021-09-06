<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />

  <div>
    @if ($this->component('header'))
      <x-dynamic-component :component="$this->component('header')" class="mb-4" />
    @endif

    @include('laravel-views::toolbar')
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-{{ $maxCols }} gap-8 md:gap-8">
    @forelse  ($this->items as $item)
      <div @if (method_exists($this, 'itemOnClick')) wire:click="itemOnClick" @endif>

        <x-dynamic-component :component="$this->component('item')" :item="$item">

          @if (!empty($this->bulkActions))
            <x-slot name="bulkCheckbox">
              <x-lv-checkbox wire:model="selected" value="{{ $item->getKey() }}" />
            </x-slot>
          @endif

          @if (!empty($this->actions))
            <x-slot name="actions">
              <x-dynamic-component :component="$this->component('actions-container')" :actions="$this->actions"
                :model="$item" />
            </x-slot>
          @endif

        </x-dynamic-component>

      </div>
    @empty
      <div class="flex justify-center items-center p-4">
        <h3>{{ __('It looks like there are no results') }}</h3>
      </div>
    @endforelse
  </div>

  {{-- Paginator, loading indicator and totals --}}
  @if ($this->items->hasPages())
    <div class="mt-8">
      {{ $this->items->links() }}
    </div>
  @endif

  @if ($this->component('footer'))
    <x-dynamic-component :component="$this->component('footer')" class="mt-4" />
  @endif

  <x-dynamic-component :component="$this->component('confirmation-message')" />
</div>