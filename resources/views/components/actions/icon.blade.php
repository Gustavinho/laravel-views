@props(['actions', 'model'])

@foreach ($actions as $action)
  @if ($action->renderIf($model, $this))
    <x-lv-icon-button :icon="$action->icon" size="sm" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')" />
  @endif
@endforeach