@component('laravel-views::components.form.input', [
  'label' => $label ?? '',
  'name' => $name ?? '',
  'placeholder' => $placeholder ?? '',
  'value' => $value ?? '',
  'model' => $model ?? '',
  'attributes' => [
    "x-data" => "{ picker: null }",
    "x-ref" => $id ?? '',
    "x-init" => 'picker = new laravelViews.Pikaday({
      field: $refs["'. ($id ?? '' ).'"],
      format: "YYYY-MM-DD",
      onSelect: function(date) {
        $dispatch("input", picker.toString("YYYY-MM-DD"));
      }
    })'
  ]
])
@endcomponent