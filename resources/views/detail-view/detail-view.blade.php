<x-dynamic-component :component="$this->getComponent('layout')">
  <div class="flex items-center mb-4 px-4">
    {!! $this->heading !!}

    <div class="flex justify-end">
      <x-dynamic-component :component="$this->getComponent('actions')" :actions="$this->actions"
        :model="$this->model" />
    </div>
  </div>

  @foreach ($this->details as $detail)
    <div class="mb-4">
      {!! $detail !!}
    </div>
  @endforeach
</x-dynamic-component>