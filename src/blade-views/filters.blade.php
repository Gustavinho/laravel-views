<div class="flex flex-row">
  @if ($searchBy)
    <div class="flex-1">
      <input
        class="block appearance-none w-full bg-white border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-purple-500 focus:border-2 border"
        type="text"
        wire:model="search"
        name="query"
        placeholder="Search..."
        autocomplete="off"
      >
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
        class="bg-white shadow-lg rounded p-4 absolute top-8 right-0 w-64 border"
        x-show="open" @click.away="open = false"
      >
        @foreach ($filtersViews as $filter)

          @include('laravel-views::' . $filter->view, [
            'view' => $filter
          ])

        @endforeach
      </div>
    </div>
  @endif
</div>