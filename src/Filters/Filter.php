<?php

namespace LaravelViews\Filters;

use Artificertech\LaravelRenderable\Concerns\IsRenderable;
use Artificertech\LaravelRenderable\Contracts\Renderable;
use Illuminate\Support\Str;

abstract class Filter implements Renderable
{
    use IsRenderable;

    /**
     * Variable name this object will have in the rendered component.
     *
     * @var string
     */
    public string $renderAs = 'filter';

    public $title;
    public $defaultValue = '';
    public $id;

    abstract public function shouldFilter($value);

    /**
     * Create a new BaseFilter instance.
     *
     * @return void
     */
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
            return Str::classNameAsSentence((new \ReflectionClass($this))->getShortName());
        }

        return $this->title;
    }

    public function getId()
    {
        return Str::camelToDash((new \ReflectionClass($this))->getShortName());
    }

    public function parseValue($value)
    {
        return $value;
    }
}
