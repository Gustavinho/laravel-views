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
    {{-- <div class="flex-1">
      <div class="relative text-left mb-4">
        <input type="text" class="pr-12 appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-600 focus:border-2 border" placeholder="Search by name...">
        <div class="absolute right-0 top-0 mt-3 mr-4 text-purple-lighter">
          <i data-feather="search" class="text-gray-400"></i>
        </div>
      </div>
    </div> --}}
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
        Filters {{ count($filters) ? "(" . count($filters) . ")" : ''}}
      </button>

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

        {{-- <div class="p-4 bg-gray-100">
          <button class="bg-blue-500 rounded px-4 py-2 w-full text-center text-white font-semibold">
            Clear filters
          </button>
        </div> --}}
      </div>
    </div>
  @endif
</div>