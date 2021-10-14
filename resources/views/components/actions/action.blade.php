@props(['action', 'key', 'variant' => 'desktop'])

@php
$executeParams = implode(',', [$key]);
@endphp

@if ($this->shouldRenderAction($action, $key))
  @switch($variant)

    @case('desktop')
      <button
        {{ $attributes->class(['border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out']) }}
        title="{{ $action->title }}"
        wire:click.prevent="executeAction('{{ $action->alias() }}', {{ $executeParams }})">
        <i data-feather="{{ $action->icon }}" class="w-5 h-5"></i>
      </button>
    @break

    @case('mobile')
      <button
        {{ $attributes->class(['group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full focus:outline-none']) }}
        wire:click.prevent="executeAction('{{ $action->alias() }}', {{ $executeParams }})">
        <i data-feather="{{ $action->icon }}" class="mr-3 h-4 w-4 text-gray-600 group-hover:text-gray-700"></i>
        {{ $action->title }}
      </button>
    @break

  @endswitch
@endif