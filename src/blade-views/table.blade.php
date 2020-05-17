<div class="min-w-full shadow-md overflow-hidden sm:rounded-lg bg-white relative">
  <div class="p-4 pb-0">
    @include('laravel-views::filters')
  </div>

  @if (session()->has('message'))
    <div class="bg-green-300 text-green-800 font-semibold p-4 flex">
      <p class="flex-1">{{ session('message') }}</p>

      {{-- Flush this message from the session --}}
      <a href="#" wire:click="flushMessage"><i data-feather="x-circle"></i></a>
    </div>
  @endif

  @if (count($items))
    <table class="min-w-full">
      <thead class="border-b border-t border-gray-200 bg-gray-100 text-xs leading-4 font-semibold uppercase tracking-wider text-left">
        <tr>
          @foreach ($headers as $header)
            <th class="px-3 py-3">
              {{ $header }}
            </th>
          @endforeach
          <th></th>
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
            <td>
              <div class="px-3 py-2 flex justify-end">
                @foreach ($actionsByRow as $action)
                  @if ($action->renderIf($item))
                    <a
                      href="{{ $action->isRedirect() ? $action->to : '#' }}"
                      @if(!$action->isRedirect()) wire:click="executeAction('{{ $action->id }}', '{{ $item->id }}', )" @endif
                    >
                      <i data-feather="{{ $action->icon }}" class="mr-2 text-gray-400 hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600"></i>
                    </a>
                  @endif
                @endforeach
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

  @else
    <div class="flex justify-center items-center p-4">
      <h1>There are no items in this table</h1>
    </div>
  @endif

  <div class="p-4 flex items-center">
    <div class="flex-1">
      {{ $items->links('laravel-views::components.paginator') }}
    </div>
    <div class="flex items-center">
      <span wire:loading class="mr-4">
        Loading
      </span>
      <div>
        <b>Showing</b> {{ $total }} items
      </div>
    </div>
  </div>
</div>
