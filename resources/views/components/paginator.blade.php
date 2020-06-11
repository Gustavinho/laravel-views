{{-- components.alert

Renders a table paginator
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,
it is using the variant helper to get the styles for each variant
it could be primary

You can customize the variants classes in config/laravel-views.php

--}}

{{-- wire:click="previousPage"
wire:click="gotoPage({{ $page }})"
wire:click="nextPage"
 --}}
@if ($paginator->hasPages())
  <div class="flex items-center">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <span class="rounded-l rounded-sm border border-brand-light px-3 py-2 cursor-not-allowed no-underline">&laquo;</span>
    @else
      <a
        class="rounded-l rounded-sm border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light no-underline cursor-pointer"
        wire:click="previousPage"
        rel="prev"
      >
        &laquo;
      </a>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
        <span class="border-t border-b border-l border-brand-light px-3 py-2 cursor-not-allowed no-underline">{{ $element }}</span>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <span class="{{ variants()->paginator('primary')->class() }} text-white border-t border-b border-l px-3 py-2 no-underline">{{ $page }}</span>
          @else
            <a class="border-t border-b border-l border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline cursor-pointer" wire:click="gotoPage({{ $page }})">{{ $page }}</a>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <a class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline" wire:click="nextPage" rel="next">&raquo;</a>
    @else
      <span class="rounded-r rounded-sm border border-brand-light px-3 py-2 hover:bg-brand-light text-brand-dark no-underline cursor-not-allowed">&raquo;</span>
    @endif
  </div>
@endif