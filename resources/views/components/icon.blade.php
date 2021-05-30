{{-- components.icon

Renders an feather icon with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles it could be success, danger, warning, info, default.

You can customize the variants classes in config/laravel-views.php

props
 - type
 - icon

--}}
@props(['icon', 'class'])
<i data-feather="{{ $icon }}" class="{{ variants()->featherIcon($type)->class() }} {{ $class }}"></i>