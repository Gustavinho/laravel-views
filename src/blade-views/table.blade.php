<div class="min-w-full shadow-md overflow-hidden sm:rounded-lg bg-white">
  <div class="p-4">
    @include('laravel-views::filters')

    <p>
      <b>Showing</b> {{ $total }} items
      <span class="ml-8" wire:loading>
        Loading
      </span>
    </p>
  </div>

  @if (count($items))
    <table class="min-w-full">
      <thead class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
        <tr>
          @foreach ($headers as $header)
            <th class="px-3 py-3">
              {{ $header }}
            </th>
          @endforeach
        </tr>
      </thead>

      <tbody>
        @foreach ($items as $item)
          <tr class="border-b border-gray-200 text-sm">
            @foreach ($view->row($item) as $column)
              <td class="px-3 py-2 whitespace-no-wrap">
                {!! $column !!}
              </td>
            @endforeach
          </tr>
        @endforeach
      </tbody>
    </table>

  @else
    <div class="flex justify-center items-center p-4">
      <h1>There are no items in this table</h1>
    </div>
  @endif

  <div class="p-4">
    {{ $items->links('laravel-views::components.paginator') }}
  </div>
</div>
