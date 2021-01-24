@props(['avatar', 'title', 'subtitle', 'actions', 'item'])

<div>
  <div class="flex items-center space-x-4 ">
    <div>
      <img src="{{ $avatar }}" alt="" class="w-12 h-12 rounded-full shadow-inner bg-white">
    </div>
    <div class="flex-1">
      {{ $title }}
      <div class="text-gray-600 text-sm">
        {{ $subtitle }}
      </div>
    </div>
    <x-lv::actions :actions="$actions" :item="$item" />
  </div>
</div>