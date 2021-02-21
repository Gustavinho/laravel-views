@props(['data', 'stripe' => false])

<ul>
  @foreach ($data as $title => $value)
    <li class="{{ $stripe && $loop->index %2 === 0 ? 'bg-gray-100' : '' }} px-4 py-5 border-b border-gray-200 sm:flex sm:items-center">
      <div class="text-xs leading-4 font-semibold uppercase tracking-wider text-gray-900 sm:w-3/12">
        {!! $title !!}
      </div>
      <div class="mt-1 text-sm leading-5 sm:mt-0 sm:w-9/12">
        {!! $value !!}
      </div>
    </li>
  @endforeach
</ul>