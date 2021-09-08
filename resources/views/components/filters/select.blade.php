@props(['filter'])

@php
$options = array_merge(['--' => null], $filter->options());
@endphp

<renderable :renderable="$this->component('form-select')" name="filters[{{ $filter->id }}]"
  model="filter.{{ $filter->id }}" :options="$options" />