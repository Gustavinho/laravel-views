@php
  [$action, $itemId] = $actionToBeConfirmed
@endphp
@if ($message)
<div class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">
  <div class="fixed inset-0 transition-opacity">
    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
  </div>
  <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
    <div class="sm:flex sm:items-start">
      <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
        <i data-feather="alert-triangle" class="text-red-600"></i>
      </div>
      <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
        <div class="mt-2">
          {{ $message }}
        </div>
        <span wire:loading class="mr-4">
          Executing action
        </span>
      </div>
    </div>
    <div wire:loading.remove class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
      <span class="flex w-full sm sm:ml-3 sm:w-auto">
        @component('laravel-views::components.button', [
          'variant' => 'danger',
          'title' => "Yes, I'm sure",
          'onWireClick' => "executeAction('$action', $itemId, false)",
          'block' => true
        ])
        @endcomponent
      </span>
      <span class="mt-3 flex w-full sm:mt-0 sm:w-auto">
        @component('laravel-views::components.button', [
          'variant' => 'light',
          'title' => 'Cancel',
          'onWireClick' => 'closeConfirmationMessage',
        ])
        @endcomponent
      </span>
    </div>
  </div>
</div>
@endif