@props(['actions', 'model'])

@foreach ($actions as $action)
  @if ($action->renderIf($model))
    <a href="#!" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}', true)" title="{{ $action->title}}" class="group flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-gray-900">
      <i data-feather="{{ $action->icon }}" class="mr-3 h-4 w-4 text-gray-600 group-hover:text-gray-700"></i>
      {{ $action->title }}
    </a>
  @endif
@endforeach