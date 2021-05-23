{{-- grid-view.grid-view

Base layout to render all the UI componentes related to the grid view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.card
  - components.paginator --}}

<x-lv-layout>
  {{-- Search input and filters --}}
  <div class="mb-2">
    @include('laravel-views::table-view.filters')
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-{{ $maxCols }} gap-8 md:gap-8">
    @foreach ($items as $item)
      @component($cardComponent, array_merge(
          $view->card($item),
          [
            'withBackground' => $withBackground,
            'model' => $item,
            'actions' => $actionsByRow,
            'hasDefaultAction' => $this->hasDefaultAction
          ]
        ))
      @endcomponent
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8">
    {{ $items->links() }}
  </div>

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</x-lv-layout>