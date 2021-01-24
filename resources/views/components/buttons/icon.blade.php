@props(['icon', 'size' => 'md'])

<button {{ $attributes }} class="{{ $size === 'sm' ? 'p-1' : 'p-2'  }} border-2 border-transparent text-gray-500 rounded-full hover:text-gray-300 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition duration-150 ease-in-out">
  <i data-feather="{{ $icon }}" class="{{ $size === 'sm' ? 'w-5 h-5' : ''  }}"></i>
</button>