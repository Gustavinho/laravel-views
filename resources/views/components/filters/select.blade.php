@props(['filter'])

<x-dynamic-component :component="$this->component('form-select')" name="{{ "filters[{$filter->id}]" }}"
  model="{{ "filters.{$filter->id}" }}" :options="array_merge(['--' => ''], $filter->options())" />