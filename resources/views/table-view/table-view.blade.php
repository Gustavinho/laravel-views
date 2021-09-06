<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />

  <div>
    @if ($this->component('header'))
      <x-dynamic-component :component="$this->component('header')" class="mb-4" />
    @endif

    @include('laravel-views::toolbar')

  </div>
  <div>
    @if (count($this->items))
      {{-- Content table --}}
      <div class="overflow-x-auto">
        <table class="min-w-full">

          <thead
            class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
            <tr>
              @if (!empty($this->bulkActions))
                <th class="pl-3">
                  <span class="flex items-center justify-center">
                    <x-lv-checkbox wire:model="allSelected" />
                  </span>
                </th>
              @endif
              {{-- Renders all the headers --}}
              @foreach ($this->headers as $header)
                <x-dynamic-component :component="$this->component('table-header')" :header="$header" />
              @endforeach

              {{-- This is a empty cell just in case there are action rows --}}
              @if (!empty($this->actions))
                <th></th>
              @endif
            </tr>
          </thead>

          <tbody>
            @foreach ($this->items as $item)
              <tr class="border-b border-gray-200 text-sm" wire:key="{{ $item->getKey() }}">
                @if (!empty($this->bulkActions))
                  <td class="pl-3">
                    <span class="flex items-center justify-center">
                      <x-lv-checkbox value="{{ $item->getKey() }}" wire:model="selected" />
                    </span>
                  </td>
                @endif
                {{-- Renders all the content cells --}}
                @foreach ($this->row($item) as $key => $column)
                  <td class="px-3 py-2 whitespace-no-wrap">
                    {{ $column }}
                  </td>
                @endforeach

                {{-- Renders all the actions row --}}
                @if (!empty($this->actions))
                  <td>
                    <div class="px-3 py-2 flex justify-end">
                      <x-dynamic-component :component="$this->component('actions-container')" :actions="$this->actions"
                        :model="$item" />
                    </div>
                  </td>
                @endif
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @else

      {{-- Empty data message --}}
      <div class="flex justify-center items-center p-4">
        <h3>{{ __('There are no items in this table') }}</h3>
      </div>

    @endif
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