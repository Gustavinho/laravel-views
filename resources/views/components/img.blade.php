{{-- components.img

Renders and image with all its variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles for each variant
it could be img, avatar

You can customize the variants classes in config/laravel-views.php

props:
 - src
 - variant
 --}}
 @props(['src', 'variant' => ''])

<img src="{{ $src }}" alt="{{ $src }}" class="{{ variants('images.'.$variant) }}">