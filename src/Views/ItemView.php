<?php

namespace LaravelViews\Views;

use Illuminate\Support\Arr;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithSortableDropdown;

abstract class ItemView extends DataView
{
    use WithSortableDropdown;

    protected $itemComponent;

    public function getHasDefaultActionProperty()
    {
        return method_exists($this, 'onItemClick');
    }

    public function getItemComponent($item)
    {
        $component = app()->call([$this, $this->itemDefinition], [
            'item' => $item,
        ]);

        if (is_array($component) && Arr::isAssoc($component)) {
            $component = UI::component($this->itemComponent, $component);
        }

        if (method_exists($this, 'extraItemProps')) {
            $component->with(
                'props',
                array_merge(
                    $this->extraItemProps($item),
                    $component->props
                )
            );
        }

        return $component;
    }
}
