@props(['actions' => [], 'model' => null])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    <div class="lg:hidden text-right relative">
      <x-dynamic-component :component="$this->getComponent('dropdown')">
        <x-slot name="trigger">
          <x-lv-icon-button icon="more-horizontal" size="sm"/>
        </x-slot>
        @foreach ($actions as $action)
        @if ($action->renderIf($model, $this))
            <x-dynamic-component :component="$action->getComponent('action-mobile')" :action="$action" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')" />
          @endif
        @endforeach
      </x-dynamic-component>
    </div>

    {{-- Desktop action buttons --}}
    <div class="hidden lg:flex justify-items-end">
      @foreach ($actions as $action)
        @if ($action->renderIf($model, $this))
        <x-dynamic-component :component="$action->getComponent('action-desktop')" :action="$action" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')" type="submit"/>
        @endif
      @endforeach
    </div>
  @endif
</div>