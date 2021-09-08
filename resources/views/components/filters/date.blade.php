@props(['filter'])

<x-lv-form.datepicker id="$filter->getId()" name="filters[{{ $filter->id }}]" model="filters[{{ $filter->id }}]"
  :value="$filter->selected()['selected']" />