  {{-- Content table --}}
  @if (count($this->items))
    <table {{ $attributes }}>

      <renderable :renderable="$this->component('table-head')" />

      <renderable :renderable="$this->component('table-body')" />

    </table>

  @else

    {{-- No results message --}}
    <renderable :renderable="$this->component('no-results')" />

  @endif