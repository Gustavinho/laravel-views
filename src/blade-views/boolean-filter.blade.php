{{-- {{ dd($view->selected()) }} --}}
<div class="text-left mb-4">
  <label class="width-full block">
    {{ $view->getTitle() }}
  </label>
  @foreach ($view->options() as $title => $option)
    <label for="checkbox-{{ $view->id }}-{{ $option }}" class="block">
      <input
        wire:model="filters.{{ $view->id }}.{{ $option }}"
        id="checkbox-{{ $view->id }}-{{ $option }}"
        type="checkbox"
        name="filters[{{ $view->id }}][{{ $option }}]"
      >
      {{ $title }}
    </label>
  @endforeach
</div>