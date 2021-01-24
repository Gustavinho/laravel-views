@props(['avatar', 'title', 'subtitle'])

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
    <div class="flex justify-end">
      <x-lv::icon-button icon="chevron-right" />
    </div>
  </div>
</div>