<x-dynamic-component :component="$this->getComponent('layout')">
  <x-slot name="header">
    <div class="flex items-center px-4 mb-4">
      <div class="flex-1">
        {!! $this->header !!}
      </div>

      <div class="flex justify-end">
        <x-dynamic-component :component="$this->getComponent('actions')" :actions="$this->actions"
          :model="$this->model" />
      </div>
    </div>
  </x-slot>

  @foreach ($this->details as $detail)
    <div class="mb-4">
      {!! $detail !!}
    </div>
  @endforeach
</x-dynamic-component>