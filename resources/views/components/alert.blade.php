{{-- components.alert

Renders the alert message with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles, icon and title depending of the alert type,
it could be success, error, warning.

You can customize the variants classes in config/laravel-views.php

props
 - type
 - message
 - onClose

--}}

@php
  $alertType = isset($type) ? $type : 'success';
@endphp

<div class="fixed z-50 bottom-0 left-0 w-full p-4 md:w-1/2 md:top-0 md:bottom-auto md:right-0 md:p-0 md:pt-8 md:pr-8 md:left-auto xl:w-1/3">
  <div class="{{ variants()->alert($alertType)->class('base') }} rounded p-4 flex items-center shadow-lg">
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
    <a href="#" wire:click.prevent="{{ $onClose ?? ''}}">
      <i data-feather="x-circle"></i>
    </a>
  </div>
</div>