<div>
  <renderable :renderable="$this->component('alerts-handler')" />
  <div class="flex items-center mb-4">
    <div class="flex-1">
      @if ($this->component('header'))
        <renderable :renderable="$this->component('header')" />
      @endif
    </div>
    <div class="flex justify-end">
      <renderable :renderable="$this->component('actions-container')" :actions="$this->actions" />
    </div>
  </div>

  <renderable :renderable="$this->component('details')" />

  @if ($this->component('footer'))
    <renderable :renderable="$this->component('footer')" />
  @endif

  <renderable :renderable="$this->component('actions-confirmation')" />
</div>