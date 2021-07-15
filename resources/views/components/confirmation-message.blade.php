<div
  x-data='{ open: false, action: "", id: "", message: ""}'
  x-init="@this.on('openConfirmationModal', (actionObject) => {
    open = true;
    action = actionObject.id;
    id = actionObject.modelId;
    message = actionObject.message;
  })"
>
  <div x-show="open" x-cloak>
    <x-lv-modal>
      <div x-text='message' class="text-gray-900 text-lg font-medium" ></div>
      <div class="mt-4 flex flex-col space-y-2 sm:space-y-0 sm:space-x-2 sm:flex-row sm:items-center">
        <x-lv-button @click="open = false" variant="white" wire:loading.attr="disabled">
          {{__("Cancel")}}
        </x-lv-button>
        <x-lv-button variant="danger" @click="await $wire.call('confirmAndExecuteAction', action, id, false); open = false" wire:loading.attr="disabled">
          {{ __("Yes, I'm sure") }}
        </x-lv-button>

        <x-lv-loading wire:loading />
      </div>
    </x-lv-modal>
  </div>
</div>