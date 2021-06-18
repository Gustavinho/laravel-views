@props(['variant' => 'primary', 'type' => 'button'])

<button {{ $attributes }} type="{{ $type }}" class="px-4 py-2 text-sm border border-transparent font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 {{ variants('buttons.' . $variant) }}">
  {{ $slot }}
</button>