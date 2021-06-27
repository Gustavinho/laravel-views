<div
  x-data='{ open: false, message: "", type: "success" }'
  x-init="@this.on('notify', (notification) => {
    open = true;
    message = notification.message;
    {{-- setTimeout(() => { open = false }, 2500) --}}
  })"
>
  <div x-show='open'>
    <template x-if="type === 'danger'">
      <x-lv-alert type='danger' onClose='open = false'>
        <div x-text='message'></div>
      </x-lv-alert>
    </template>
    <template x-if="type === 'success'">
      <x-lv-alert onClose='open = false'>
        <div x-text='message'></div>
      </x-lv-alert>
    </template>
  </div>
</div>