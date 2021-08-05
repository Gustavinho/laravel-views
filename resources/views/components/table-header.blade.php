@props(['header', 'sortBy' => null, 'sortOrder' => null])

<th {{$attributes->merge([
    'class' => 'px-3 py-3',
    'width' => $header->width
])}} >
    @if (is_string($header))
      {{ $header }}
    @else
      @if ($header->isSortable())
        <div class="flex">
          <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex-1">
            {{ $header->title }}
          </a>
          <a href="#!" wire:click.prevent="sort('{{ $header->sortBy }}')" class="flex">
            <i data-feather="chevron-up" class="{{ $sortBy === $header->sortBy && $sortOrder === 'asc' ? 'text-gray-900' : 'text-gray-400'}} h-4 w-4"></i>
            <i data-feather="chevron-down" class="{{ $sortBy === $header->sortBy && $sortOrder === 'desc' ? 'text-gray-900' : 'text-gray-400'}} h-4 w-4"></i>
          </a>
        </div>
      @else
        {{ $header->title }}
      @endif
    @endif
  </th>