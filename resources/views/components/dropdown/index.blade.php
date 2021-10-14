{{-- components/drop-down.blade

Renders the a dropdown button with its different variants
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

- slots:
 - trigger --}}

@props(['dropDownWidth' => 'w-64', 'label' => ''])

<div {{ $attributes->class(['relative']) }} x-data="{ open: false }">
  <span @click="open = true" class="cursor-pointer">
    @if ($label)
      <x-lv-buttons.select>
        {{ __($label) }}
      </x-lv-buttons.select>
    @else
      @isset($trigger)
        {{ $trigger }}
      @endisset
    @endif
  </span>

  <div class="bg-white shadow-lg rounded absolute top-8 right-0 border text-left z-10 {{ $dropDownWidth }}"
    x-show.transition="open" @click.away="open = false" x-cloak>
    {{ $slot }}
  </div>
</div>