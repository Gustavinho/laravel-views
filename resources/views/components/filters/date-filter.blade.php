{{-- components.filters.date.blade

Renders the datepicker for the date filter
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/datepicker --}}

@component('laravel-views::components.form.datepicker', [
  'name' => "filters[{$view->id}]",
  'model' => "filters.{$view->id}",
  'value' => $view->selected()['selected'],
  'id' => $view->getId(),
])
@endcomponent