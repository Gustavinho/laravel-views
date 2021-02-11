<x-lv-layout>
  <x-lv-actions :actions="$this->actions" :model="$model" />

  @foreach ($components as $component)
    {!! $component !!}
  @endforeach

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</x-lv-layout>