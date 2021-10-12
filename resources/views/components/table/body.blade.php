<tbody {{ $attributes }}>
  @foreach ($this->items as $key => $item)
    <renderable :renderable="$this->component('table-head-row')" wire:key="{{ $key }}">
      <x-slot name="content">

        {{-- If there are bulk actions display the select checkbox --}}
        @if (!empty($this->bulkActions))
          <renderable :renderable="$this->component('table-bulk-actions-cell')">
            <x-slot name="content">
              <div class="flex items-center justify-center">
                <x-lv-form.checkbox value="{{ $key }}" wire:model="selected" />
              </div>
            </x-slot>
          </renderable>
        @endif

        {{-- Renders all the content cells --}}
        @foreach ($this->row($item) as $content)
          <renderable :renderable="$this->component('table-cell')" :content="$content" />
        @endforeach

        {{-- Renders the actions column --}}
        @if (!empty($this->actions))
          <renderable :renderable="$this->component('table-actions-cell')">
            <x-slot name="content">
              <renderable :renderable="$this->component('actions-container')" :actions="$this->actions" :key="$key" />
            </x-slot>
          </renderable>
        @endif

      </x-slot>
    </renderable>
  @endforeach
</tbody>