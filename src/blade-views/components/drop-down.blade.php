<div
  class="flex-1 text-right relative"
  x-data="{ open: false }"
>
  @component('laravel-views::components.button', [
    'title' => $title,
    "onClick" => "open = true"
  ])
  @endcomponent

  <div
    class="bg-white shadow-lg rounded absolute top-8 right-0 w-64 border text-left pt-4"
    x-show="open" @click.away="open = false"
  >
    {{ $slot }}
  </div>
</div>