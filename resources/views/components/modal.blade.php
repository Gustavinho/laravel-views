<div class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center z-50">
  <div class="fixed inset-0 transition-opacity">
    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
  </div>
  <div class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
    <div class="bg-white z-50">
      {{ $slot }}
    </div>
  </div>
</div>