<?php

namespace LaravelViews\Data;

use Illuminate\Http\Request;

class QueryStringData
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getSearchValue($currentValue)
    {
        return $this->request->query('search', $currentValue);
    }

    /**
     * Casts all boolean values of the querystring from string to boolean
     * this is needed to set the boolean filter values properly
     */
    public function getFilterValues($currentValue)
    {
        $filters = $this->request->query('filters', $currentValue);

        return collect($filters)->map(function ($filter) {
            /** If is an array that means it came from a boolean filter */
            if (is_array($filter)) {
                foreach ($filter as $option => $checked) {
                    /** Casts from string to boolean */
                    $filter[$option] = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
                }
            }

            return $filter;
        })->toArray();
    }

    /**
     * Get a value from the query string
     * @param string $field query param name
     * @param string $currentValue Default value
     */
    public function getValue($field, $currentValue)
    {
        return $this->request->query($field, $currentValue);
    }
}
