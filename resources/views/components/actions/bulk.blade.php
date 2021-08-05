@props(['showSelectAll' => true])
<div class="flex space-x-1">
  @if (count($this->selected) > 0)
    <x-dynamic-component :component="$this->getComponent('bulk-dropdown', 'dropdown')" label='Actions'>
      <x-dynamic-component :component="$this->getComponent('bulk-dropdown-header', 'dropdown-header')"
        label='{{ count($this->selected) }} Selected' />
      @foreach ($this->bulkActions as $action)
        <x-dynamic-component :component="$action->getComponent('action-bulk', 'icon-text-button')" :icon="$action->icon"
          :text="$action->title" wire:click.prevent="executeBulkAction('{{ $action->id }}')" />
      @endforeach
    </x-dynamic-component>
  @endif

  @if ($this->bulkActions && $showSelectAll)
    <button wire:click="$set('allSelected', {{ !$this->allSelected }})"
      class="border border-transparent hover:border-gray-300 focus:border-gray-300 focus:outline-none flex items-center gap-1 text-xs px-3 py-2 rounded hover:shadow-sm font-medium">
      {{ __($this->allSelected ? 'Unselect all' : 'Select all') }}
    </button>
  @endif
</div>