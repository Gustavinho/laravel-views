@props(['actions', 'model' => null])

@foreach ($actions as $action)
  @if ($action->renderIf($model, $this))
    <x-lv-icon-button
      :icon="$action->icon"
      size="sm"
      wire:click.prevent="{{ $model ? "executeAction('{$action->id}','{$model->getKey()}')" : "executeBulkAction('{$action->id}')" }}"
    />
  @endif
@endforeach