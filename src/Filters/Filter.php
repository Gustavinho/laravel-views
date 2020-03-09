<?php

namespace Gustavinho\LaravelViews\Filters;

class Filter
{
    public $type = 'select';

    protected $title = null;

    public function getTitle()
    {
        if (!$this->title) {
            return $this->camelToTitle((new \ReflectionClass($this))->getShortName());
        }

        return $this->title;
    }

    private function camelToTitle($camelStr)
    {
        $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $camelStr);
        $titleStr = preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);

        return $titleStr;
    }
}
