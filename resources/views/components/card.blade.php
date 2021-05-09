<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  <img src="{{ $image }}" alt="" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}">

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-start">
      <div class="flex-1">
        <h3 class="font-bold leading-6">
          {{ $title }}
        </h3>
        @if ($subtitle)
          <span class="text-sm text-gray-600">
            {{ $subtitle }}
          </span>
        @endif
      </div>

      <div class="flex justify-end items-center">
        <div>
          <x-lv-drop-down>
            <x-slot name="trigger">
              <x-lv-icon-button icon="more-horizontal" size="sm"/>
            </x-slot>

            <x-lv-actions.icon-and-title :actions="$actions" :model="$model" />
          </x-lv-drop-down>
        </div>
      </div>
    </div>

    @if ($description)
      <p class="line-clamp-3 mt-2">
        {{ $description }}
      </p>
    @endif
  </div>

</div>