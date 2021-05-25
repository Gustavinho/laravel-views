{{-- components/drop-down.blade

Renders the a dropdown button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props:
 - $title
 - $variant
 - $slot
 - $dropDownClasses

UI components used:
 - button --}}

<div
  class="relative"
  x-data="{ open: false }"
>
  @isset($trigger)
    <span
      @click="open = true"
      class="cursor-pointer"
    >
      {{ $trigger }}
    </span>
  @else
    @component('laravel-views::components.button', [
      'title' => $title,
      "onClick" => "open = true",
      "variant" => $variant ?? 'primary'
    ])
    @endcomponent
  @endisset

  <div
    class="bg-white shadow-lg rounded absolute top-8 right-0 border text-left z-10 {{ isset($dropDownClasses) ? $dropDownClasses : 'w-full' }}"
    x-show.transition="open"
    @click.away="open = false"
    x-cloak
  >
    {{ $slot }}
  </div>
</div>