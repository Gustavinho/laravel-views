{{-- table-view.date.blade

Renders a datepicker input
To customize it you should shange the UI component used, YOU SHOULD NOT CUSTOMIZE ANYHING HERE
UI components used:
  - form/input
props:
 - $label
 - $name
 - $placeholder
 - $value
 - $model
 - $id
--}}

@component('laravel-views::components.form.input', [
  'label' => $label ?? '',
  'name' => $name ?? '',
  'placeholder' => $placeholder ?? '',
  'value' => $value ?? '',
  'model' => $model ?? '',
  'id' => $id,
  'attributes' => 'x-data="window.laravelViews.datePicker()" x-ref="'.$id.'" x-init="init(\'' . $id . '\', $dispatch)"',
])
@endcomponent