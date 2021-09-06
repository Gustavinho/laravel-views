<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />
  <div class="flex items-center mb-4">
    <div class="flex-1">
      @if ($this->component('header'))
        <x-dynamic-component :component="$this->component('header')"
          :attributes="$this->componentAttributes('header')" />
      @endif
    </div>
    <div class="flex justify-end">
      <x-dynamic-component :component="$this->component('actions-container')"
        :attributes="$this->componentAttributes('actions-container')" :actions="$this->actions" :model="$this->model" />
    </div>
  </div>

  <x-dynamic-component :component="$this->component('details')" :attributes="$this->componentAttributes('details')" />

  <x-dynamic-component :component="$this->component('confirmation-message')"
    :attributes="$this->componentAttributes('confirmation-message')" />
</div>