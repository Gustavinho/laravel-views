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
      @foreach ($this->row($item) as $key => $content)
        <renderable :renderable="$this->component('table-cell')" :content="$content" />
      @endforeach

      {{-- Renders all the actions row --}}
      @if (!empty($this->actions))
        <td>
          <div class="px-3 py-2 flex justify-end">
            <renderable :renderable="$this->component('actions-container')" :actions="$this->actions" :model="$item" />
          </div>
        </td>
      @endif
    </tr>
  @endforeach
</tbody>
