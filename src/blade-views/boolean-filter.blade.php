@foreach ($view->options() as $title => $value)
  <label for="checkbox-{{ $view->id }}-{{ $value }}">
    <input
      wire:model="filters.{{ $view->id }}.{{ $value }}"
      id="checkbox-{{ $view->id }}-{{ $value }}"
      type="checkbox"
      name="filters[{{ $view->id }}][{{ $value }}]"
      {{ isset($selected[$value]) ? 'checked': '' }}
    >
    {{ $title }}
  </label>
@endforeach