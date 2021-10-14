@props(['filter'])

<x-lv-form.datepicker :id="$filter->id" name="{{ $filter->id }}" model="{{ $filter->id }}"
  :value="$this->{$filter->id}" />