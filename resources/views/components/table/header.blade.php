@props(['content' => null])

<th {{ $attributes }}>
  @if ($content instanceof \Artificertech\LaravelRenderable\Contracts\Renderable)
    <renderable :renderable="$content" />
  @else
    {{ $content }}
  @endif
</th>