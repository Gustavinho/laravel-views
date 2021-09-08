<div x-data='{ open: false, message: "", type: "success" }' x-init="@this.on('notify', (notification) => {
    open = true;
    message = notification.message;
    {{-- setTimeout(() => { open = false }, 2500) --}}
  })">
  <div x-show='open'>
    <template x-if="type === 'danger'">
      <renderable :renderable="$this->component('alert')" type='danger' onClose='open = false'>
        <div x-text='message'></div>
      </renderable>
    </template>
    <template x-if="type === 'success'">
      <renderable :renderable="$this->component('alert')" onClose='open = false'>
        <div x-text='message'></div>
      </renderable>
    </template>
  </div>
</div>
