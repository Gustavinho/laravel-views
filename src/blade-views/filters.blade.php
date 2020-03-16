<div class="mb-25">
  @if ($searchBy)
    <div>
      <input wire:model="search" type="text" class="" name="query" placeholder="Buscar...">
    </div>
  @endif

  @if (isset($filtersViews) && $filtersViews)
    {{-- <b>Filtros {{ count($filters) ? "(" . count($filters) . ")" : ''}} </b> --}}
    @foreach ($filtersViews as $filter)

      @include('laravel-views::' . $filter->view, [
        'view' => $filter
      ])

    @endforeach

  @endif
</div>