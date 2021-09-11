  <div {{ $attributes->class(['relative text-left']) }}>
    <input
      class="appearance-none w-full bg-white border-gray-300 hover:border-gray-500 px-3 py-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 focus:border-2 border"
      type="text" placeholder="{{ __('Search') }}" autocomplete="off" wire:model="search">
    <div class="absolute right-0 top-0 mt-2 mr-4 text-purple-lighter">
      <a wire:click.prevent="clearSearch" href="#" class="text-gray-400 hover:text-blue-600">
        <i data-feather="{{ $this->search ? 'x-circle' : 'search' }}" class="w-4"></i>
      </a>
    </div>
  </div>