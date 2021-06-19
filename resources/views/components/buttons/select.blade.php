{{-- components.buttons.select

Renders a button like a select dropdown. Most likely used in conjunction with the components.drop-down
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles for each variant
it could be primary, primary-light

You can customize the variants classes in config/laravel-views.php

props
 - icon --}}
@props(['icon' => 'chevron-down'])
<button
  class="border border-transparent hover:border-gray-300 focus:border-gray-300 focus:outline-none flex items-center gap-1 text-xs px-3 py-2 rounded hover:shadow-sm font-medium"
>
  {{ $slot }}
  @if ($icon)
    <i data-feather="{{ $icon }}" class="w-4 h-4"></i>
  @endif
</button>
