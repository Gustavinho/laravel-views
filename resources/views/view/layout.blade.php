<div class="">
  {{-- Success/Error feedback --}}
  <x-dynamic-component :component="$this->getComponent('alerts-handler')"/>

  {{ $slot }}

  <x-dynamic-component :component="$this->getComponent('confirmation-message')"/>
</div>