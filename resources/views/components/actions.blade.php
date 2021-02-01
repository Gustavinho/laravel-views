@props(['actions', 'item'])

<div>
  {{-- Mobile actions dropdown --}}
  <div class="lg:hidden">
    <x-lv::drop-down>
      <x-slot name="trigger">
        <x-lv::icon-button icon="more-vertical" size="sm" />
      </x-slot>

      @foreach ($actions as $action)
        @if ($action->renderIf($item))
          <a href="#!" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $item->id }}', true)" title="{{ $action->title}}" class="group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
            <i data-feather="{{ $action->icon }}" class="mr-3 h-4 w-4 text-gray-600 group-hover:text-gray-700"></i>
            {{ $action->title }}
          </a>
        @endif
      @endforeach
    </x-lv::drop-down>
  </div>

  {{-- Desktop action buttons --}}
  <div class="hidden lg:flex justify-items-end">
    @foreach ($actions as $action)
      @if ($action->renderIf($item))
        <x-lv::icon-button :icon="$action->icon" size="sm" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $item->id }}', true)" />
      @endif
    @endforeach
  </div>
</div>