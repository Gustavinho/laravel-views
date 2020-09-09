{{-- grid-view.grid-view

Base layout to render all the UI componentes related to the grid view, this is the main file for this view,
the rest of the files are included from here

You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIERE DIRECTIVES

UI components used:
  - table-view.filters
  - components.alert
  - components.card
  - components.paginator --}}

<div>
  {{-- Search input and filters --}}
  <div class="mb-2">
    @include('laravel-views::table-view.filters')
  </div>

  {{-- Success/Error feedback --}}
  @if (session()->has('message'))
    @component('laravel-views::components.alert', [
      'message' => session('message'),
      'onClose' => 'flushMessage',
      'type' => session('messageType')
    ])
    @endcomponent
  @endif

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 col-gap-8 row-gap-12">
    @foreach ($items as $item)
      <div x-data='{ overlay: false }' class="relative">
        <div x-on:mouseover='overlay = true' x-on:mouseleave='overlay = false'>
          {{-- Renders all the actions row --}}
          @if (count($actionsByRow) > 0)
            <div x-show.transition='overlay' class="p-2 absolute top-0 right-0">
              @component('laravel-views::components.drop-down', ['title' => 'Actions'])
                <ul class="mb-4">
                  @foreach ($actionsByRow as $action)
                    {{-- This renderIf method is implemented in every action --}}
                    @if ($action->renderIf($item))
                      <li class="py-2 px-4">
                        @component('laravel-views::components.action', ['action' => $action, 'item' => $item])
                          <i data-feather="{{ $action->icon }}" class="mr-4"></i>
                          <span>{{ $action->title }}</span>
                        @endcomponent
                      </li>
                    @endif
                  @endforeach
                </ul>
              @endcomponent
            </div>
          @endif

          @component($cardComponent, array_merge(
              $view->card($item),
              ['withBackground' => $withBackground]
            ))
          @endcomponent
        </div>
      </div>
    @endforeach
  </div>

  {{-- Paginator, loading indicator and totals --}}
  <div class="mt-8 flex items-center">
    <div class="flex-1">
      {{ $items->links() }}
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

  @include('laravel-views::components.confirmation-message', ['message' => $confirmationMessage])
</div>