<x-lv-layout>
  <div class="flex items-center mb-4 px-4">
    <div class="flex-1">
      <div class="font-bold text-2xl text-gray-900">
        {{ $title }}
      </div>
      @isset ($subtitle)
        <span class="text-sm">{{ $subtitle }}</span>
      @endisset
    </div>

    <div class="flex justify-end">
      <x-lv-actions :actions="$this->actions" :model="$model" />
    </div>
  </div>

  @foreach ($components as $component)
    <div class="mb-4">
      {!! $component !!}
    </div>
  @endforeach

  @include('laravel-views::components.confirmation-message')
</x-lv-layout>