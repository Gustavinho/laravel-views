<div>
  <x-dynamic-component :component="$this->component('alerts-handler')" />
  <div class="flex items-center px-4 mb-4">
    <div class="flex-1">
      {!! $this->header !!}
    </div>

    <div class="flex justify-end">
      <x-dynamic-component :component="$this->component('actions-container')" :actions="$this->actions"
        :model="$this->model" />
    </div>
  </div>

  @foreach ($this->details as $detail)
    <div class="mb-4">
      {!! $detail !!}
    </div>
  @endforeach

  <x-dynamic-component :component="$this->component('confirmation-message')" />
</div>