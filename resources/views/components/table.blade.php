<div>
  {{-- Content table --}}
  @if (count($this->items))
    <table class="overflow-x-auto min-w-full">

      <renderable :renderable="$this->component('table-head')" />

      <renderable :renderable="$this->component('table-body')" />

    </table>

  @else

    {{-- Empty data message --}}
    <div class="flex justify-center items-center p-4">
      <h3>{{ __('There are no items in this table') }}</h3>
    </div>

  @endif
</div>
