<div class="">
  <label>{{ $label }}</label>
  <select name="{{ $name }}" class="{{ $class ?? '' }}">
    @if (count($options))
      @foreach ($options as $option => $value)
        <option value="{{ $value }}" {{ isset($selected) && $selected != '' && $selected == $value ? 'selected' : ''}}>
          {{ $option }}
        </option>
      @endforeach
    @endif
  </select>
</div>