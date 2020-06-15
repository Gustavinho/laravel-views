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
  class="flex-1 text-right relative"
  x-data="{ open: false }"
>
  @component('laravel-views::components.button', [
    'title' => $title,
    "onClick" => "open = true",
    "variant" => $variant ?? 'primary'
  ])
  @endcomponent

  <div
    class="bg-white shadow-lg rounded absolute top-8 right-0 w-64 border text-left pt-4"
    x-show="open" @click.away="open = false"
  >
    {{ $slot }}
  </div>
</div>