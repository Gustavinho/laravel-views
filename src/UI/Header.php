<?php

namespace LaravelViews\UI;

class Header extends Cell
{
    /** @var string Header's title to be shown */
    public $title;

    /** @var string Field the table view will be sort by */
    public $sortBy;

    /** @var string Width the width of the table column */
    public $width;

    /**
     * Sets the header's title
     * @param string $title Header's title to be shown
     */
    public function title(string $title)
    {
        $header = $this->content($title);
        $header->title = $title;

        return $header;
    }

    /**
     * Sets the sort by field
     * @param string $field Field the table view will be sort by
     * @return Header
     */
    public function sortBy(string $field)
    {
        $this->sortBy = $field;

        return $this;
    }

    /**
     * Checks if this header is sortable
     * @return bool
     */
    public function isSortable(): bool
    {
        return !empty($this->sortBy);
    }

    /**
     * Sets a fixed width of the column
     * @return Header
     */
    public function width(string $width)
    {
        $this->width = $width;

        return $this;
    }
}
