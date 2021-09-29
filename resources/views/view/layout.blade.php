<div class="">
  {{-- Success/Error feedback --}}
  <x-lv-alerts-handler />

  {{ $slot }}

  {{-- Confirmation message alert --}}
  <x-lv-confirmation-message />
</div>