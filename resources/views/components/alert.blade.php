@php
  $alertType = isset($type) ? $type : 'success';
@endphp
<div class="{{ variants()->alert($alertType)->class('base') }} border-b border-bottom mb-4 p-4 flex items-center">
  <div class="{{ variants()->alert($alertType)->class('icon') }} mr-4 rounded-full p-2">
    <div class="{{ variants()->alert($alertType)->class('base') }} rounded-full p-1 border-2">
      <i data-feather="{{ variants()->alert($alertType)->icon() }}" class="text-sm w-4 h-4 font-semibold"></i>
    </div>
  </div>

  <div class="flex-1">
    <b class="{{ variants()->alert($alertType)->title('base') }} font-semibold">
      {{ variants()->alert($alertType)->title() }}!
    </b>
    <p class="text-sm">{{ $message }}</p>
  </div>

  {{-- Flush this message from the session --}}
  <a href="#" wire:click="{{ $onClose ?? ''}}">
    <i data-feather="x-circle"></i>
  </a>
</div>