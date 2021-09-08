@props(['filter'])

@php
$options = array_merge(['--' => null], $filter->options());
@endphp

<x-lv-form.select name="filters[{{ $filter->id }}]" model="filter.{{ $filter->id }}" :options="$options" />