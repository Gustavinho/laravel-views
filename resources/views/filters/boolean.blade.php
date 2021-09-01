@props(['filter'])

<div class="px-4 mt-4">
  <div class="text-left mb-4">
    @foreach ($filter->options() as $title => $option)
      <label for="checkbox-{{ $filter->id }}-{{ $option }}" class="block">
        <input wire:model="filter.{{ $filter->id }}.{{ $option }}"
          id="checkbox-{{ $filter->id }}-{{ $option }}" type="checkbox"
          name="filter[{{ $filter->id }}][{{ $option }}]" class="mr-2">
        {{ $title }}
      </label>
    @endforeach
  </div>
</div>