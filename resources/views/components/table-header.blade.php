@props(['header'])

<th {{ $attributes->merge([
    'class' => 'px-3 py-3',
    'width' => $header->width,
]) }}>
  @if ($header->isSortable())
    <div class="flex">
      <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex-1">
        {{ $header->title }}
      </a>
      <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex">
        <i data-feather="chevron-up"
          class="{{ $this->sortBy === $header->sortBy && $this->sortOrder === 'asc' ? 'text-gray-900' : 'text-gray-400' }} h-4 w-4"></i>
        <i data-feather="chevron-down"
          class="{{ $this->sortBy === $header->sortBy && $this->sortOrder === 'desc' ? 'text-gray-900' : 'text-gray-400' }} h-4 w-4"></i>
      </a>
    </div>
  @else
    {{ $header->title }}
  @endif
</th>