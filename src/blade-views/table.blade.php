<div>
  @include('laravel-views::filters')

  <p class="mt-4 mb-4">
    <b>Showing</b> {{ $total }} items
    <span class="ml-8" wire:loading>
      Loading
    </span>
  </p>

  <div class="min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
    @if (count($items))
      <table class="min-w-full">
        <thead class="bg-gray-200">
          <tr>
            @foreach ($headers as $header)
              <th class="px-3 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-600 uppercase tracking-wider">
                {{ $header }}
              </th>
            @endforeach
          </tr>
        </thead>

        <tbody>
          @foreach ($items as $item)
            <tr>
              @foreach ($view->row($item) as $column)
                <td class="px-3 py-2 whitespace-no-wrap border-b border-gray-200 text-gray-900 text-sm">
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
  </div>

  {{ $items->links('laravel-views::components.paginator') }}
</div>
