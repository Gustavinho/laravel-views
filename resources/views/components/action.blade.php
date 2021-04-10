{{-- This renderIf method is implemented in every action --}}
@php
  $class = 'flex hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600"'
@endphp
@if ($action->renderIf($item))
  <a href="#!" title="{{$action->title}}" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $item->getKey() }}', true)" class="{{ $class }}">
    {{ $slot }}
  </a>
@endif
