@props(['actions' => [], 'model' => null, 'desktop' => true, 'mobile' => true])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    @if ($mobile)
    
    <div @class([
      'text-right relative',
      'lg:hidden' => $desktop
      ])>
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
    @endif

    {{-- Desktop action buttons --}}
    @if ($desktop)
    <div @class([
      'lg:flex justify-items-end',
      'hidden' => $mobile
      ])>
      @foreach ($actions as $action)
        @if ($action->renderIf($model, $this))
        <x-dynamic-component :component="$action->getComponent('action-desktop')" :action="$action" wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')" type="submit"/>
        @endif
      @endforeach
    </div>
    @endif
  @endif
</div>