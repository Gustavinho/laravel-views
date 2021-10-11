@props(['bulkActions', 'showSelectAll' => true])

@if (count($this->selected) > 0)
  <x-lv-dropdown label='Actions'>
    <x-lv-dropdown.header label='{{ count($this->selected) }} Selected' />
    @foreach ($bulkActions as $action)
      <renderable :renderable="$action" />
    @endforeach
  </x-lv-dropdown>
@endif

@if ($showSelectAll)
  <button wire:click="$set('allSelected', {{ !$this->allSelected }})"
    class="border border-transparent hover:border-gray-300 focus:border-gray-300 focus:outline-none flex items-center gap-1 text-xs px-3 py-2 rounded hover:shadow-sm font-medium">
    {{ __($this->allSelected ? 'Unselect all' : 'Select all') }}
  </button>
@endif