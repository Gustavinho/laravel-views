<?php

namespace LaravelViews\UI;

class Header
{
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
        $this->title = $title;

        return $this;
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
     * @return Header
     */
    public function isSortable(): bool
    {
        return !empty($this->sortBy);
    }
}
