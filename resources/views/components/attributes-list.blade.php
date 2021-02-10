@props(['data'])

<div>
  <ul>
    @foreach ($data as $label => $value)
      <li>{{ $label }} {{ $value }}</li>
    @endforeach
  </ul>
</div>