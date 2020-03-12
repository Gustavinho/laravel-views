<?php

namespace Gustavinho\LaravelViews\Filters;

class BaseFilter
{
    protected $title;
    public $id;

    public function __construct()
    {
        $this->id = $this->getId();
    }

    /**
     * Get filter title
     */
    public function getTitle()
    {
        if (!$this->title) {
            return $this->camelToTitle((new \ReflectionClass($this))->getShortName());
        }

        return $this->title;
    }

    public function getId()
    {
        return $this->camelToDashCase((new \ReflectionClass($this))->getShortName());
    }

    private function camelToTitle($camelStr)
    {
        $intermediate = preg_replace('/(?!^)([[:upper:]][[:lower:]]+)/', ' $0', $camelStr);
        $titleStr = preg_replace('/(?!^)([[:lower:]])([[:upper:]])/', '$1 $2', $intermediate);

        return $titleStr;
    }

    private function camelToDashCase($camelStr)
    {
        return strtolower(preg_replace('%([a-z])([A-Z])%', '\1-\2', $camelStr));
    }

    public function passValuesFromRequestToFilter($values)
    {
        return $values;
    }
}
