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
    @foreach ($this->headers() as $header)
      <renderable :renderable="$this->component('table-header')" class="p-3" :header="$header" />
    @endforeach

    {{-- This is a empty cell just in case there are action rows --}}
    @if (!empty($this->actions))
      <th></th>
    @endif
  </tr>
</thead>
