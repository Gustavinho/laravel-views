<div class="bg-green-300 text-green-800 font-semibold p-4 flex">
  <p class="flex-1">{{ $message }}</p>

  {{-- Flush this message from the session --}}
  <a href="#" wire:click="{{ $onClose ?? ''}}"><i data-feather="x-circle"></i></a>
</div>