<div class="flex flex-row">
  @if ($searchBy)
    <div class="flex-1">
      @component('laravel-views::components.form.input', [
        'name' => 'query',
        'placeholder' => 'Search',
        'model' => "search"
      ])
      @endcomponent
    </div>
  @endif

  @if (isset($filtersViews) && $filtersViews)
    <div
      class="flex-1 text-right relative"
      x-data="{ open: false }"
    >
      <button
        class="bg-gray-200 hover:bg-gray-400 active:bg-gray-400 focus:bg-gray-400 py-2 px-4 rounded focus:outline-none shadow"
        @click="open = true"
      >
        Filtros {{ count($filters) ? "(" . count($filters) . ")" : ''}}
      </button>

      <div
        class="bg-white shadow-lg rounded absolute top-8 right-0 w-64 border text-left pt-4"
        x-show="open" @click.away="open = false"
      >
        @foreach ($filtersViews as $filter)
          <div class="px-4">
            @include('laravel-views::' . $filter->view, [
            'view' => $filter
            ])
          </div>
        @endforeach

        {{-- <div class="p-4 bg-gray-100">
          <button class="bg-blue-500 rounded px-4 py-2 w-full text-center text-white font-semibold">
            Clear filters
          </button>
        </div> --}}
      </div>
    </div>
  @endif
</div>