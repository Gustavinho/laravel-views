@php
  $variants = [
    'primary' => ['text' => 'white', 'bg' => 'blue-600', 'hover' => 'blue-500', 'focus' => 'blue-500', 'active' => 'blue-500'],
    'primary-light' => ['text' => 'blue-700', 'bg' => 'blue-200', 'hover' => 'blue-600 hover:text-white', 'focus' => 'blue-600 focus:text-white', 'active' => 'blue-600 active:text-white'],
    'light' => ['text' => 'gray-900', 'bg' => 'gray-200', 'hover' => 'gray-300', 'focus' => 'gray-300', 'active' => 'gray-300'],
    'success' => ['text' => 'white', 'bg' => 'green'],
];
  $buttonVariant = $variants[$variant ?? 'primary']
@endphp

<button
  class="py-2 px-4 rounded focus:outline-none {{ isset($block) ? 'w-full' : '' }} text-{{ $buttonVariant['text'] }} shadow bg-{{ $buttonVariant['bg'] }} hover:bg-{{ $buttonVariant['hover'] }} active:bg-{{ $buttonVariant['active'] }} focus:bg-{{ $buttonVariant['focus'] }}"
  @click="{{ $onClick ?? '' }}"
  {{-- {{ attributes($attributes ?? null) }} --}}
>
  {{ $title }}
</button>