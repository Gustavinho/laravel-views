@props(['content'])

<td {{ $attributes->class(['px-3 py-2 whitespace-no-wrap']) }}>
  @if ($content instanceof \Artificertech\LaravelRenderable\Contracts\Renderable)
    <renderable :renderable="$content" />
  @else
    {{ $content }}
  @endif
</td>