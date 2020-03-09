<div class="mb-25">
  <form>
    @if ($fieldsToSearch)
      <input type="text" class="" name="query" placeholder="Buscar..." value="{{ $searchValue }}">
    @endif

    @if ($filters)
      <b>Filtros {{ count($filtersValues) ? "(" . count($filtersValues) . ")" : ''}} </b>
      @foreach ($filters as $filter)

        {{-- Select filter --}}
        @if ($filter->type === 'select')
          @component('laravel-views::components.form.select', [
            'label' => $filter->getTitle(),
            'name' => "filters[{$filter->field}]",
            'options' => array_merge(['--' => ''], $filter->options()),
            'selected' => count($filtersValues) ? $filtersValues[$filter->field] : '',
          ])
          @endcomponent
        @endif

      @endforeach

      <button type="submit" class="">
        Aplicar filtros
      </button>
    @endif
  </form>
</div>