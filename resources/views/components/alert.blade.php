{{-- components.alert

Renders the alert message with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles, icon and title depending of the alert type,
it could be success, error, warning.

You can customize the variants classes in config/laravel-views.php
--}}
@props(['type' => 'success', 'onClose' => ''])

<div class="fixed z-50 bottom-0 left-0 w-full p-4 md:w-1/2 md:top-0 md:right-0 md:p-8 md:left-auto xl:w-1/3 h-auto">
  <div class="bg-white rounded p-4 flex items-center shadow-lg h-auto">
    <div class="{{ variants()->alert($type)->class('icon') }} mr-4 rounded-full p-2">
      <div class="{{ variants()->alert($type)->class('base') }} rounded-full p-1 border-2">
        <i data-feather="{{ variants()->alert($type)->icon() }}" class="text-sm w-4 h-4 font-semibold"></i>
      </div>
    </div>

    <div class="flex-1">
      <b class="{{ variants()->alert($type)->title('base') }} text-gray-900 font-semibold">
        {{ variants()->alert($type)->title() }}!
      </b>
      <div class="text-sm">
        {{ $slot }}
      </div>
    </div>

    {{-- Flush this message from the session --}}
    <button @click.prevent="{{ $onClose ?? ''}}">
      <i data-feather="x-circle"></i>
    </button>
  </div>
</div>