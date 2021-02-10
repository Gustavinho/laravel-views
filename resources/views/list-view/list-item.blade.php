@props(['avatar', 'title', 'subtitle', 'actions', 'model'])

<div>
  <div class="flex items-center space-x-4 ">
    <div>
      <img src="{{ $avatar }}" alt="" class="w-12 h-12 rounded-full shadow-inner bg-white">
    </div>
    <div class="flex-1">
      <div class="font-medium">
        {{ $title }}
      </div>
      <div class="text-gray-600 text-sm">
        {{ $subtitle }}
      </div>
    </div>
    <x-lv-actions :actions="$actions" :item="$model" />
  </div>
</div>