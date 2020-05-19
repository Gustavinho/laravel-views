<div class="flex flex-row">
  {{-- Search input --}}
  @if ($searchBy)
    <div class="flex-1">
      @component('laravel-views::components.form.input-group', [
        'placeholder' => 'Search',
        'model' => 'search',
        'onClick' => 'clearSearch',
        'icon' => $search ? 'x-circle' : 'search'
      ])
      @endcomponent
    </div>
  @endif

  {{-- Filters dropdown --}}
  @if (isset($filtersViews) && $filtersViews)
    @component('laravel-views::components.drop-down', [
      'title' => "Filters " . (count($filters) ? "(" . count($filters) . ")" : ''),
    ])
      @foreach ($filtersViews as $filter)
        <div class="px-4">
          @include('laravel-views::' . $filter->view, [
            'view' => $filter,
            'filter' => $filter,
          ])
        </div>
      @endforeach

      @if (count($filters) > 0)
        <div class="p-4 bg-gray-100">
          <a wire:click="clearFilters" @click="open = false" href="#" class="text-blue-600 flex hover:text-blue-500">
            <i data-feather="x-circle" class="mr-2"></i>
            Clear filters
          </a>
        </div>
      @endif
    @endcomponent
  @endif
</div>