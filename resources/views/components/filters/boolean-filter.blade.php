{{-- components.filters.boolean.blade
Renders the input radius for the boolean filter
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES
--}}

<div class="text-left mb-4">
  @foreach ($view->options() as $title => $option)
    <label for="checkbox-{{ $view->id }}-{{ $option }}" class="block">
      <input
        wire:model="filters.{{ $view->id }}.{{ $option }}"
        id="checkbox-{{ $view->id }}-{{ $option }}"
        type="checkbox"
        name="filters[{{ $view->id }}][{{ $option }}]"
        class="mr-2"
      >
      {{ $title }}
    </label>
  @endforeach
</div>