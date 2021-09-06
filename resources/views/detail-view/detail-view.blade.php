<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />
  <div class="flex items-center px-4 mb-4">
    @if ($this->component('header'))
      <x-dynamic-component :component="$this->component('header')" class="flex-1" />
    @endif

    <div class="flex justify-end">
      <x-dynamic-component :component="$this->component('actions-container')" :actions="$this->actions"
        :model="$this->model" />
    </div>
  </div>

  <x-dynamic-component :component="$this->component('details')" />

  <x-dynamic-component :component="$this->component('confirmation-message')" />
</div>