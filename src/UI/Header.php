<?php

namespace LaravelViews\UI;

class Header
{
    /** @var string Header's title to be shown */
    public $title;

    /** @var string Field the table view will be sort by */
    public $sortBy;

    /** @var string Width the width of the table column */
    public $width;

    /** @var string Breakpoint (min-width) from where column is displayed */
    public $visibleBreakpoint;

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

    /**
     * Sets breakpoint from where column will be displayed
     * @return Header
     */
    public function hideOnMobile(string $visibleBreakpoint = 'md')
    {
        $this->visibleBreakpoint = $visibleBreakpoint;

        return $this;
    }

    /**
     * Gets responsive table cell class names
     * @return string
     */
    public function getResponsiveClassNames()
    {
        if (empty($this->visibleBreakpoint)) return '';

        return match ($this->visibleBreakpoint) {
            'sm' => 'hidden sm:table-cell',
            'lg' => 'hidden lg:table-cell',
            'xl' => 'hidden xl:table-cell',
            '2xl' => 'hidden 2xl:table-cell',
            default => 'hidden md:table-cell'
        };
    }
}
