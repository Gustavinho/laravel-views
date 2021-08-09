@props(['actions' => [], 'model' => null, 'desktop' => true, 'mobile' => true])

<div>
  @if (count($actions))
    {{-- Mobile actions dropdown --}}
    @if ($mobile)

      <div class="{{ 'text-right relative ' . ($desktop ? 'lg:hidden' : '') }}">
        <x-dynamic-component :component="$this->getComponent('actions-dropdown', 'dropdown')">
          <x-slot name="trigger">
            <x-lv-icon-button icon="more-horizontal" size="sm" />
          </x-slot>
          @foreach ($actions as $action)
            @if ($action->renderIf($model, $this))
              <x-dynamic-component :component="$action->getComponent('action-mobile', 'icon-text-button')"
                :icon="$action->icon" :text="$action->title"
                wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')">
              </x-dynamic-component>
            @endif
          @endforeach
        </x-dynamic-component>
      </div>
    @endif

    {{-- Desktop action buttons --}}
    @if ($desktop)
      <div class="{{ 'lg:flex justify-items-end ' . ($mobile ? 'hidden' : '') }}">
        @foreach ($actions as $action)
          @if ($action->renderIf($model, $this))
            <x-dynamic-component :component="$action->getComponent('action-desktop', 'icon-button')"
              :icon="$action->icon" :title="$action->title" size="sm"
              wire:click.prevent="executeAction('{{ $action->id }}', '{{ $model->getKey() }}')" />
          @endif
        @endforeach
      </div>
    @endif
  @endif
</div>