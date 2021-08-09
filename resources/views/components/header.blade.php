@props(['title' => '', 'subtitle' => ''])

<div>
  <div class="font-bold text-2xl text-gray-900">
    {{ $title }}
  </div>
  @isset($subtitle)
    <span class="text-sm">{{ $subtitle }}</span>
  @endisset
</div>