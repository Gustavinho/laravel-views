<div>
  <x-dynamic-component :component="$this->getComponent('alerts-handler')" />

  {{ $header ?? '' }}

  {{ $slot }}

  {{ $footer ?? '' }}

  <x-dynamic-component :component="$this->getComponent('confirmation-message')" />
</div>