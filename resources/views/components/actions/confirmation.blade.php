<div x-data='{ open: false, action: "", id: "", message: "", args: {}}' x-init="@this.on('openConfirmationModal', (actionObject) => {
    open = true;
    action = actionObject.alias;
    message = actionObject.message;
    args = actionObject.args;
  })">
  <div x-show="open" x-cloak {{ $attributes }}>
    <x-lv-modal>
      <div x-text='message' class="text-gray-900 text-lg font-medium"></div>
      <div class="mt-4 flex flex-col space-y-2 sm:space-y-0 sm:space-x-2 sm:flex-row sm:items-center">
        <x-lv-button @click="open = false" variant="white" wire:loading.attr="disabled">
          {{ __('Cancel') }}
        </x-lv-button>
        <x-lv-button variant="danger"
          @click="await $wire.call('executeAction', action, 'actionConfirmed', ...args); open = false"
          wire:loading.attr="disabled">
          {{ __('Confirm') }}
        </x-lv-button>
        <span wire:loading class="animate-spin">
          <x-lv-icon icon="loader" />
        </span>
      </div>
    </x-lv-modal>
  </div>
</div>