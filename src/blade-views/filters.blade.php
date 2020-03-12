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
            'name' => "filters[{$filter->id}]",
            'options' => array_merge(['--' => ''], $filter->options()),
            'selected' => count($filtersValues) && isset($filtersValues[$filter->id]) ? $filtersValues[$filter->id] : '',
          ])
          @endcomponent
        @endif

        @if ($filter->type === 'boolean')
          @foreach ($filter->options() as $title => $value)
            <label for="checkbox-{{ $filter->id }}-{{ $value }}">
              <input
                id="checkbox-{{ $filter->id }}-{{ $value }}"
                type="checkbox"
                name="filters[{{ $filter->id }}][{{ $value }}]"
                {{ count($filtersValues) && isset($filtersValues[$filter->id]) && isset($filtersValues[$filter->id][$value]) ? 'checked': '' }}
              >
              {{ $title }}
            </label>
          @endforeach
        @endif

      @endforeach

      <button type="submit" class="">
        Aplicar filtros
      </button>
    @endif
  </form>
</div>