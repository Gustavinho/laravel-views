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

    public function getTitleProperty()
    {
        if (method_exists($this, 'title')) {
            return app()->call([$this, 'title'], ['model' => $this->model]);
        }

        return $this->heading[0];
    }

    public function getSubtitleProperty()
    {
        if (method_exists($this, 'subtitle')) {
            return app()->call([$this, 'subtitle'], ['model' => $this->model]);
        }

        return $this->heading[1];
    }

    public function getheadingProperty()
    {
        if (method_exists($this, 'heading')) {
            $heading = app()->call([$this, 'heading'], [
                'model' => $this->model,
            ]);


            if (is_array($heading)) {
                // If there is an array of data insted of a component
                // then creates a new attributes component
                if (!Arr::isAssoc($heading)) {
                    $heading = array_combine(['title', 'subtitle'], $heading);
                }

                $heading = UI::component('laravel-views::detail-view.heading', $heading);
            }

            return $heading;
        }

        return null;
    }

    public function getModelWhoFiredAction()
    {
        return $this->model;
    }
}
