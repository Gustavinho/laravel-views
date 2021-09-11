@props(['model'])

@if (!empty(($title = $this->title)))
  <div {{ $attributes }}>
    <div class="font-bold text-2xl text-gray-900">
      {{ $title }}
    </div>
    @if (!empty(($subtitle = $this->subtitle)))
      <span class="text-sm">{{ $subtitle }}</span>
    @endif
  </div>
@endif