<div
  x-cloak
  x-data='{ open: false, message: "", type: "success" }'
  x-init="@this.on('notify', (notification) => {
    open = true;
    message = notification.message;
    type = notification.type;
    {{-- setTimeout(() => { open = false }, 2500) --}}
  })"
>
  <div x-show="open && type === 'danger'">
    <x-lv-alert type='danger' onClose='open = false'>
      <div x-text='message'></div>
    </x-lv-alert>
  </div>
  <div x-show="open && type === 'success'">
    <x-lv-alert onClose='open = false'>
      <div x-text='message'></div>
    </x-lv-alert>
  </div>
</div>