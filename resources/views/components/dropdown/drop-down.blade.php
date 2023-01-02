{{-- components/drop-down.blade

Renders the a dropdown button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

- slots:
 - trigger
--}}

@props(['size' => null, 'label' => ''])

<div
  class="relative"
  x-data="{ open: false }"
>
  <span @click="open = true" class="cursor-pointer">
    @if ($label)
      <x-lv-select-button>
        {{ __($label) }}
      </x-lv-select-button>
    @else
      @isset($trigger)
        {{ $trigger }}
      @endisset
    @endif
  </span>

  <div
    {{ $attributes->class([
      'bg-white shadow-lg rounded absolute top-8 right-0 border text-left z-10 ',
      'w-full' => $size === 'full',
      'w-64' => !$size,
      'w-48' => $size === 'sm',
    ])}}
    x-show.transition="open"
    @click.away="open = false"
    x-cloak
  >
    {{ $slot }}
  </div>
</div>