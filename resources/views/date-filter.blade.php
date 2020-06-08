@component('laravel-views::components.form.datepicker', [
  'name' => "filters[{$view->id}]",
  'model' => "filters.{$view->id}",
  'value' => $view->selected()['selected'],
  'id' => $view->getId(),
])
@endcomponent