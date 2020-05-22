@component('laravel-views::components.form.select', [
  'label' => $view->getTitle(),
  'name' => "filters[{$view->id}]",
  'model' => "filters.{$view->id}",
  'options' => array_merge(['--' => ''], $view->options()),
])
@endcomponent