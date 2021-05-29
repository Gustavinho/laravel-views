@if ($searchBy)
  <div class="flex-1">
    @component('laravel-views::components.form.input-group', [
      'placeholder' => 'Search',
      'model' => 'search',
      'onClick' => 'clearSearch',
      'icon' => $search ? 'x-circle' : 'search',
      ])
    @endcomponent
  </div>
@endif
