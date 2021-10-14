@props(['filter'])

<div class="px-4 mt-4">
  <div class="text-left mb-4" x-data="{selectedOptions: @entangle($filter->id)}">
    @foreach ($filter->options() as $title => $option)
      <label for="checkbox-{{ $filter->id }}-{{ $option }}" class="block">
        <input x-model="selectedOptions" id="checkbox-{{ $filter->id }}-{{ $option }}" type="checkbox"
          class="mr-2" value="{{ $option }}">
        {{ $title }}
      </label>
    @endforeach
  </div>
</div>