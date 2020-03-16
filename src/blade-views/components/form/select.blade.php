<div class="">
  <label>{{ $label }}</label>
  <select {{ isset($model) ? 'wire:model='.$model : '' }} name="{{ $name }}" class="{{ $class ?? '' }}">
    @if (count($options))
      @foreach ($options as $option => $value)
        <option value="{{ $value }}" {{ isset($selected) && $selected != '' && $selected == $value ? 'selected' : ''}}>
          {{ $option }}
        </option>
      @endforeach
    @endif
  </select>
</div>