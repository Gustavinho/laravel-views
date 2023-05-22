<?php

namespace LaravelViews\UI;

class Header
{
    /** @var string Header's title to be shown */
    public $title;

    /** @var string Field the table view will be sort by */
    public $sortBy;

    /** @var int Compare items as strings using "natural ordering" like natsort() */
    public $sortNatural;

    /** @var string Width the width of the table column */
    public $width;

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
     * @return Header
     */
    public function sortBy(string $field)
    {
        $this->sortBy = $field;

        return $this;
    }

    /**
     * Sets the sort method
     * @param bool $sortnat If the table view should be sorted by "natural ordering" like natsort()
     * @return Header
     */
    public function sortNatural(int $sortnat = 1)
    {
        $this->sortNatural = $sortnat;

        return $this;
    }

    /**
     * Checks if this header is sortable
     * @return bool
     * @return Header
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
