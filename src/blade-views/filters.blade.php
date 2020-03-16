<div class="mb-25">
  @if ($searchBy)
    <input wire:model="search" type="text" class="" name="query" placeholder="Buscar...">
  @endif

  @if (isset($filters) && $filters)
    <b>Filtros {{ count($filtersValues) ? "(" . count($filtersValues) . ")" : ''}} </b>
    @foreach ($filters as $filter)

      {!! $filter->render() !!}

    @endforeach

    <button type="submit" class="">
      Aplicar filtros
    </button>
  @endif
</div>