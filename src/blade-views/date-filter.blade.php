@component('laravel-views::components.form.datepicker', [
  'label' => $view->getTitle(),
  'name' => "filters[{$view->id}]",
  'model' => "filters.{$view->id}",
  'value' => $view->selected()['selected'],
  'id' => $view->getId(),
])
@endcomponent