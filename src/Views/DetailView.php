<?php

namespace LaravelViews\Views;

use Exception;
use Illuminate\Support\Arr;
use LaravelViews\Facades\UI;
use LaravelViews\Views\Traits\WithActions;

class DetailView extends View
{
    use WithActions;

    protected $view = 'detail-view.detail-view';
    protected $modelClass;

    public $model;

    public function mount()
    {
        $this->setModel();
    }

    private function setModel()
    {
        if (is_numeric($this->model)) {
            if (!$this->modelClass) {
                throw new Exception('A $modelClass should be declared when the initial model value is an ID');
            }

            $this->model = $this->modelClass::find($this->model);
        }
    }

    public function getDetailsProperty()
    {
        $details = app()->call([$this, 'details'], [
            'model' => $this->model,
        ]);

        if (is_array($details)) {
            // If there is an array of data insted of a component
            // then creates a new attributes component
            if (Arr::isAssoc($details)) {
                $details = [UI::propertyList($details)];
            }
            // If there is only one component
        } else {
            $details = [$details];
        }

        return $details;
    }

    public function getModelWhoFiredAction()
    {
        return $this->model;
    }

    protected function appCallData()
    {
        return ['model' => $this->model];
    }
}
