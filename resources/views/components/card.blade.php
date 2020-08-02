<div class="{{ $withBackground ? 'rounded-md shadow-md' : '' }}">
  <img src="{{ $image }}" alt="" class="rounded-md h-48 w-full object-cover {{ $withBackground ? 'rounded-b-none' : '' }}">

  <div class="pt-4 {{ $withBackground ? 'bg-white rounded-b-md p-4' : '' }}">
    <div class="flex items-center mb-2">

      <h2 class="font-bold flex-1">
        {{ $title }}
      </h2>

      <div class="flex justify-end items-center">
        <span class="text-sm text-gray-600">
          {{ $subtitle }}
        </span>
      </div>
    </div>

    <div style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden">
      {{ $description }}
    </div>
  </div>

</div>