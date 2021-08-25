<div x-data='{ open: false, message: "", type: "success" }' x-init="@this.on('notify', (notification) => {
    open = true;
    message = notification.message;
    {{-- setTimeout(() => { open = false }, 2500) --}}
  })">
  <div x-show='open'>
    <template x-if="type === 'danger'">
      <x-dynamic-component :component="$this->component('alert')" type='danger' onClose='open = false'>
        <div x-text='message'></div>
      </x-dynamic-component>
    </template>
    <template x-if="type === 'success'">
      <x-dynamic-component :component="$this->component('alert')" onClose='open = false'>
        <div x-text='message'></div>
      </x-dynamic-component>
    </template>
  </div>
</div>