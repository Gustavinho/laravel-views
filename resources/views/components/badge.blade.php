{{-- components.badge

Renders a badge with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles it could be success, danger, warning, info, default.

You can customize the variants classes in config/laravel-views.php

props
 - type
 - title

--}}
@props(['type', 'title'])


<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ variants('badges.'. $type) }}">
  {{ $title }}
</span>