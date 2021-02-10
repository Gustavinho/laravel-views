<?php

namespace LaravelViews\Views;

use Exception;
use Illuminate\Support\Arr;
use LaravelViews\Facades\UI;

class DetailView extends View
{
    protected $view = 'detail-view.detail-view';
    protected $modelClass;

    public $model;

    public function mount()
    {
        if (is_numeric($this->model)) {
            if (!$this->modelClass) {
                throw new Exception('A modelClass should be declared when the initial model value is an ID');
            }

            $this->model = $this->modelClass::find($this->model);
        }
    }

    protected function getRenderData()
    {
        $components = app()->call([$this, 'detail'], [
            'model' => $this->model,
        ]);

        if (is_array($components)) {
            // If there is an array of data insted of a component
            // then creates a new attributes component
            if (Arr::isAssoc($components)) {
                $components = [UI::attributes($components)];
            }
        // If there is only one component
        } else {
            $components = [$components];
        }

        return [
            'components' => $components,
        ];
    }
}
