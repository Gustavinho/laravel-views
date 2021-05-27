{{-- This renderIf method is implemented in every action --}}
@php
    $class = 'flex hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600"'
@endphp
@if ($action->renderIf($item))

    <div x-data="{ tooltip: false }" class="cursor-pointer relative z-30 inline-flex"
         @mousemove.away="tooltip = false"
    >
        <button
                @mousemove="setInterval(function(){tooltip = false}, 2000); tooltip = true"
                @mouseleave="tooltip = false"
                wire:click.prevent="executeAction('{{ $action->id }}', '{{ $item->getKey() }}', true)"
                class="{{ $class }}">
            {{ $slot }}
        </button>
        <div class="relative" x-cloak x-show.transition.origin.top="tooltip"
             @mousemove="tooltip = false"
        >
            <div
                    @mousemove="tooltip = false"
                    class="flex justify-center absolute top-0 z-30 w-32 p-2 -mt-3 text-sm leading-tight text-white transform -translate-x-1/2 -translate-y-full bg-gray-400 rounded-md shadow-md">
                {{ $action->title }}
            </div>
            <svg class="absolute z-30 w-6 h-6 text-gray-400 transform -translate-x-8 -translate-y-5 fill-current stroke-current"
                 width="8" height="8">
                <rect x="12" y="-10" width="8" height="8" transform="rotate(45)"/>
            </svg>
        </div>
    </div>

@endif
