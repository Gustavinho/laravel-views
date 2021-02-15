<x-lv-layout>
  <div class="flex items-center mb-8 px-4 sm:px-0 ">
    <div class="flex-1">
      <div class="font-bold text-2xl text-gray-900">
        {{ $title }}
      </div>
      @isset ($subtitle)
        <span>{{ $subtitle }}</span>
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

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</x-lv-layout>