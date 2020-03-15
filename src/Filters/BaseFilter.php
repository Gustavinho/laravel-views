<?php

namespace Gustavinho\LaravelViews\Filters;

use Gustavinho\LaravelViews\Views\View;
use Illuminate\Http\Request;

class BaseFilter extends View
{
    protected $title;
    public $id;

    public function __construct()
    {
        $this->id = $this->getId();
    }

    public function getData(Request $request)
    {
        $selected = '';

        if ($request->has('filters')) {
            $filters = $request->get('filters');
            if (isset($filters[$this->id])) {
                $value = $filters[$this->id];
                if ($value != "" && $value != null) {
                    $selected = $value;
                }
            }
        }

        return [
            'selected' => $selected
        ];
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
