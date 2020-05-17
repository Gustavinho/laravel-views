<div class="flex flex-row">
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

  @if (isset($filtersViews) && $filtersViews)
    <div
      class="flex-1 text-right relative"
      x-data="{ open: false }"
    >
      @component('laravel-views::components.button', [
        'title' => "Filters " . (count($filters) ? "(" . count($filters) . ")" : ''),
        "onClick" => "open = true"
      ])
      @endcomponent

      <div
        class="bg-white shadow-lg rounded absolute top-8 right-0 w-64 border text-left pt-4"
        x-show="open" @click.away="open = false"
      >
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
      </div>
    </div>
  @endif
</div>