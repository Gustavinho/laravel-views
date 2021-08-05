{{-- components.filters.select.blade

Renders the dropdown for the select filter
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/select --}}

@component('laravel-views::components.form.select', [
  'name' => "filters[{$view->id}]",
  'model' => "filters.{$view->id}",
  'options' => array_merge(['--' => ''], $view->options()),
])
@endcomponent