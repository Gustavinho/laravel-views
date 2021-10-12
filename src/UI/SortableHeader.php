<?php

namespace LaravelViews\UI;

use Artificertech\LaravelRenderable\Concerns\IsRenderable;
use Artificertech\LaravelRenderable\Contracts\Renderable;

class SortableHeader implements Renderable
{
    use IsRenderable;

    public $renderAs = 'header';
    public $component = 'laravel-views::sortable-header';

    /** @var string Header's title to be shown */
    public $title;

    /** @var string Field the table view will be sort by */
    public $sortBy;

    /**
     * Sets the header's title
     * @param string $title Header's title to be shown
     */
    public function title(string $title)
    {
        $header = new static;
        $header->title = $title;

        return $header;
    }

    /**
     * Sets the sort by field
     * @param string $field Field the table view will be sort by
     * @return SortableHeader
     */
    public function sortBy(string $field)
    {
        $this->sortBy = $field;

        return $this;
    }

    /**
     * Checks if this header is sortable
     * @return bool
     * @return SortableHeader
     */
    public function isSortable(): bool
    {
        return !empty($this->sortBy);
    }
}
