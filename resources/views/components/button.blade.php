{{-- components.alert

Renders the a button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles for each variant
it could be primary, primary-light

You can customize the variants classes in config/laravel-views.php

props
 - title
 - block
 - variant

--}}
<button
  class="py-2 px-4 rounded focus:outline-none {{ isset($block) ? 'w-full' : '' }} shadow {{ variants()->button($variant ?? 'primary')->class() }}"
  @click="{{ $onClick ?? '' }}"
>
  {{ $title }}
</button>