@props(['icon', 'size' => 'md'])

<button
  {{ $attributes->merge([
    'class' => 'border-2 border-transparent text-gray-600 rounded-full hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:bg-gray-100 transition duration-150 ease-in-out',
]) }}>
  <x-dynamic-component :component="$this->getComponent('icon-button-icon', 'icon')" :icon="$icon"
    class="{{ $size === 'sm' ? 'w-5 h-5' : '' }}" />
</button>