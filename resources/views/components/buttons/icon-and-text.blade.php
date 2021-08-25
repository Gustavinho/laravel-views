@props(['icon', 'text' => ''])

<button
  {{ $attributes->merge(['class' => 'group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900 w-full focus:outline-none']) }}
  {{ $attributes->wire('click') }}>
  <x-dynamic-component :component="$this->component('icon-text-button-icon', 'icon')" :icon="$icon"
    class="mr-3 h-4 w-4 text-gray-600 group-hover:text-gray-700" />
  {{ $text }}
</button>