<?php

namespace LaravelViews\Views\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait WithSearch
{
    /** @var String $search Current query string with the search value */
    public $search;

    /** @var Array<String> $searchBy All fields to search */
    public $searchBy;

    public $queryStringWithSearch = [
        'search' => ['except' => '']
    ];

    public function mountWithSearch(Request $request)
    {
        $this->search = $request->query('search', $this->search);
    }

    public function updatingWithSearch($name, $value)
    {
        if ($name == 'search' && method_exists($this, 'resetPage')) {
            $this->resetPage(); // reset pagingation
        }
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    /**
     * Check if each of the filters has a default value and it's not already set
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applySearch(&$data)
    {
        if ($this->search) {
            if ($data instanceof Builder) {
                $this->applySearchToBuilder($data);
            } else if ($data instanceof Collection) {
                $this->applySearchToCollection($data);
            }
        }

        return $this;
    }

    protected function applySearchToBuilder(&$query)
    {
        $relationalFields = array_filter($this->searchBy, static function ($item) {
            return str_contains($item, '.');
        });

        $regularFields = array_diff($this->searchBy, $relationalFields);

        $query->where(function ($query) use ($regularFields, $relationalFields) {
            $this->applyRegularFields($regularFields, $query, $this->search);
            $this->applyRelationalFields($relationalFields, $query, $this->search);
        });
    }

    protected function applySearchToCollection(&$data)
    {
        $data =  $data->filter(function ($item) {
            foreach ($this->searchBy as $key) {
                if (false !== strpos(data_get($item, $key), $this->search)) {
                    return true;
                }
            }
        });
    }

    /**
     * @param $relationalFields
     * @param $query
     * @param String $value
     */
    protected static function applyRelationalFields($relationalFields, $query, string $value): void
    {
        foreach ($relationalFields as $relationalValue) {
            [$relationship, $field] = explode('.', $relationalValue);

            $query->orWhereHas($relationship, static function ($query) use ($value, $field) {
                $query->where($field, 'like', "%{$value}%");
            });
        }
    }

    /**
     * @param array $regularFields
     * @param $query
     * @param String $value
     */
    protected function applyRegularFields(array $regularFields, $query, string $value): void
    {
        foreach ($regularFields as $field) {
            $query->orWhere($field, 'like', "%{$value}%");
        }
    }
}
