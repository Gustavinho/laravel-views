@props(['tooltip' => ''])

<div x-data="{ tooltip: false }" class="cursor-pointer relative inline-flex" @mousemove.away="tooltip = false">
  <span @mousemove="tooltip = true" @mouseleave="tooltip = false">
    {{ $slot }}
  </span>

  <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
    <div class="flex justify-center absolute top-0 z-10 w-32 p-2 -mt-3 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-gray-800 rounded-md shadow-md">
      {{ $tooltip }}
    </div>
    <svg class="absolute z-10 w-6 h-6 text-gray-800 transform -translate-x-8 -translate-y-5 fill-current stroke-current" width="8" height="8">
      <rect x="12" y="-10" width="8" height="8" transform="rotate(45)" />
    </svg>
  </div>
</div>