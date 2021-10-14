@props(['filter'])

@php
$options = array_merge(['--' => null], $filter->options());
@endphp

<x-lv-form.select name="{{ $filter->id }}" model="{{ $filter->id }}" :options="$options" />