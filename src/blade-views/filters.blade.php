<div class="mb-25">
  @if ($searchBy)
    <input wire:model="search" type="text" class="" name="query" placeholder="Buscar...">
  @endif

  @if (isset($filtersViews) && $filtersViews)
    {{-- <b>Filtros {{ count($filtersValues) ? "(" . count($filtersValues) . ")" : ''}} </b> --}}
    @foreach ($filtersViews as $filter)

      {{-- {!! $filter->render() !!} --}}
      @include('laravel-views::' . $filter->view, [
        'view' => $filter
      ])

    @endforeach

    <button type="submit" class="">
      Aplicar filtros
    </button>
  @endif
</div>