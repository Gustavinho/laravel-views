@props(['filter'])

@component('laravel-views::components.form.select', [
  'name' => "filters[{$filter->id}]",
  'model' => "filters.{$filter->id}",
  'options' => array_merge(['--' => ''], $filter->options()),
  ])
@endcomponent