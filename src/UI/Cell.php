<?php

namespace LaravelViews\UI;

class Cell
{
    /** @var string Cell's content to be shown */
    public $content;

    /** @var string Breakpoint (min-width) from where cell is displayed */
    public $visibleBreakpoint;

    /** @var string Additional class names to be added to cell */
    public $classNames;

    /**
     * Sets the cells's content
     * @param string $content Cell's content to be shown
     */
    public function content(string $content)
    {
        $cell = new static;
        $cell->content = $content;

        return $cell;
    }

    /**
     * Adds class names to table cell
     * @return Cell
     */
    public function classNames(string $classNames)
    {
        $this->classNames = $classNames;

        return $this;
    }

    /**
     * Sets breakpoint from where cell will be displayed
     * @return Cell
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
