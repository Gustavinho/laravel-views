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