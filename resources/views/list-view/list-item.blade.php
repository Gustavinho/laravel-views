@props(['avatar', 'title', 'subtitle', 'actions', 'model'])

<div class="flex space-x-4">
  <div>
    <img src="{{ $avatar }}" alt="" class="w-12 h-12 rounded-full shadow-inner bg-white object-cover">
  </div>
  <div class="flex-1">
    <div class="text-sm font-medium text-gray-900">
      {{ $title }}
    </div>
    <div class="text-sm">
      {{ $subtitle }}
    </div>
  </div>
</div>