<div>
  {{-- Search input and filters --}}
  <div class="mb-2">
    @include('laravel-views::table-view.filters')
  </div>

  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 col-gap-6 row-gap-8">
    @foreach ($items as $item)
      <div class="rounded">
        <img src="{{ $view->cell($item)['photo'] }}" alt="" class="rounded-md h-48 w-full object-cover">
        <div class="mt-4">
          <div class="flex items-center mb-2">
            <h2 class="font-bold flex-1">{{ $view->cell($item)['title'] }}</h2>
            <div class="flex justify-end items-center">
              <span class="text-sm text-gray-600">{{ $view->cell($item)['subtitle'] }}</span>
            </div>
          </div>
          <div style="display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical; overflow: hidden">
            {{ $view->cell($item)['description'] }}
          </div>
        </div>
        {{-- <div>{{ $view->cell($item)['description'] }}</div> --}}
      </div>
    @endforeach
  </div>
</div>