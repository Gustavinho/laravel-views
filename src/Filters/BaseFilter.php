<?php

namespace LaravelViews\Filters;

use Illuminate\Support\Str;

class BaseFilter
{
    protected $title;
    public $defaultValue;
    public $id;

    public function __construct()
    {
        $this->id = $this->getId();
    }

    public function selected()
    {
        $request = request();
        $selected = '';

        if ($request->has('filters')) {
            $filters = $request->get('filters');
            if (isset($filters[$this->id])) {
                $value = $filters[$this->id];
                if ($value != "" && $value != null) {
                    $selected = $value;
                    if (is_array($selected)) {
                        foreach ($selected as $key => $value) {
                            $selected[$key] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        }
                    }
                }
            }
        }

        return [
            'selected' => $selected
        ];
    }

    public function value()
    {
        return $this->selected()['selected'];
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

    public function passValuesFromRequestToFilter($values)
    {
        return $values;
    }
}
