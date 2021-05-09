{{-- components/drop-down.blade

Renders the a dropdown button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props:
 - $title
 - $varian
 - $slot

UI components used:
 - button --}}

<div
  class="text-right relative"
  x-data="{ openDropDown: false }"
>
  @isset($trigger)
    <div @click="openDropDown = true; console.log('hola')" class="cursor-pointer">
      {{ $trigger }}
    </div>
  @else
    @component('laravel-views::components.button', [
      'title' => $title,
      "onClick" => "open = true",
      "variant" => $variant ?? 'primary'
    ])
    @endcomponent
  @endisset

  <div
    class="bg-white shadow-lg rounded absolute top-8 right-0 w-64 border text-left z-40"
    x-show.transition="openDropDown"
    @click.away="openDropDown = false"
    x-cloak
  >
    {{ $slot }}
  </div>
</div>