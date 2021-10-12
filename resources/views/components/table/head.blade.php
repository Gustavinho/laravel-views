<thead {{ $attributes }}>
  <renderable :renderable="$this->component('table-head-row')">
    <x-slot name="content">

      {{-- If there are bulk actions display the select all checkbox --}}
      @if (!empty($this->bulkActions))
        <renderable :renderable="$this->component('table-bulk-actions-header')">
          <x-slot name="content">
            <div class="flex items-center justify-center">
              <x-lv-form.checkbox wire:model="allSelected" />
            </div>
          </x-slot>
        </renderable>
      @endif

      {{-- Renders all the headers --}}
      @foreach ($this->headers() as $header)
        <renderable :renderable="$this->component('table-header')" class="p-3" :content="$header" />
      @endforeach

      {{-- This is a empty cell just in case there are actions --}}
      @if (!empty($this->actions))
        <renderable :renderable="$this->component('table-actions-header')" />
      @endif

    </x-slot>
  </renderable>
</thead>