<div class="mb-25">
  <form>
    @if ($fieldsToSearch)
      <input type="text" class="" name="query" placeholder="Buscar..." value="{{ $searchValue }}">
    @endif

    @if ($filters)
      <b>Filtros {{ count($filtersValues) ? "(" . count($filtersValues) . ")" : ''}} </b>
      @foreach ($filters as $filter)

        {!! $filter->render() !!}

      @endforeach

      <button type="submit" class="">
        Aplicar filtros
      </button>
    @endif
  </form>
</div>