{{-- components.buttons.select

Renders a button like a select dropdown. Most likely used in conjunction with the components.drop-down
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles for each variant
it could be primary, primary-light

You can customize the variants classes in config/laravel-views.php

props
 - title
 - icon --}}
@props(['icon' => 'chevron-down'])
<button
  class="w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none text-left">
  <div class="truncate overflow-x-hidden">{{ $title }}</div>
  <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
    <i data-feather="{{ $icon }}"
      class="w-4 h-4"></i>
  </div>
</button>
