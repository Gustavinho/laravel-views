@if ($this->searchBy)
  @component('laravel-views::components.form.input-group', [
    'placeholder' => 'Search',
    'model' => 'search',
    'onClick' => 'clearSearch',
    'icon' => $this->search ? 'x-circle' : 'search',
    ])
  @endcomponent
@endif
