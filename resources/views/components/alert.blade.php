@php
  $alerts = [
    'success' => ['color' => 'green', 'icon' => 'check'],
    'warning' => ['color' => 'yellow', 'icon' => 'alert-circle'],
    'error' => ['color' => 'red', 'icon' => 'x']
  ];
  $alertType = isset($type) ? $type : 'success';
  $color = $alerts[$alertType]['color'];
@endphp
<div class="bg-{{ $color }}-100 border-b-2 border-bottom border-{{ $color }}-300 text-{{ $color }}-700 mb-4 p-4 flex items-center">
  <div class="mr-4 bg-{{ $color }}-200 rounded-full p-2">
    <div class="bg-{{ $color }}-100 rounded-full p-1 border-2 border-{{ $color }}-300 ">
      <i data-feather="{{ $alerts[$alertType]['icon'] }}" class="text-sm text-{{ $color }}-900 w-4 h-4 font-semibold"></i>
    </div>
  </div>

  <div class="flex-1">
    <b class="text-{{ $color }}-900 font-semibold">Success!</b>
    <p class="text-sm">{{ $message }}</p>
  </div>

  {{-- Flush this message from the session --}}
  <div>
    <a href="#" wire:click="{{ $onClose ?? ''}}"><i data-feather="x-circle"></i></a>
  </div>
</div>