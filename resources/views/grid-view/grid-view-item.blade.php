@props([
  'image',
  'title',
  'subtitle',
  'description',
  'withBackground',
  'model',
  'actions',
  'hasDefaultAction'
])

<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  @if ($hasDefaultAction)
    <a href="#!" wire:click.prevent="onCardClick({{ $model->id }})">
      <img src="{{ $image }}" alt="{{ $image }}" class="hover:shadow-lg cursor-pointer rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}">
    </a>
  @else
    <img src="{{ $image }}" alt="{{ $image }}" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}">
  @endif

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6 text-gray-900">
          @if ($hasDefaultAction)
            <a href="#!" class="hover:underline" wire:click.prevent="onCardClick({{ $model->getKey() }})">
              {{ $title }}
            </a>
          @else
            {{ $title }}
          @endif
        </h3>
        @if ($subtitle)
          <span class="text-sm text-gray-600">
            {{ $subtitle }}
          </span>
        @endif
      </div>

      <div class="flex justify-end items-center">
        <x-lv-drop-down>
          <x-slot name="trigger">
            <x-lv-icon-button icon="more-horizontal" size="sm"/>
          </x-slot>
          <x-lv-actions.icon-and-title :actions="$actions" :model="$model" />
        </x-lv-drop-down>
      </div>
    </div>

    @if (isset($description))
      <p class="line-clamp-3 mt-2">
        {{ $description }}
      </p>
    @endif
  </div>

</div>