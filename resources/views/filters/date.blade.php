@props(['filter'])


@component('laravel-views::components.form.datepicker', [
  'name' => "filters[{$filter->id}]",
  'model' => "filters.{$filter->id}",
  'value' => $filter->selected()['selected'],
  'id' => $filter->getId(),
])
@endcomponent