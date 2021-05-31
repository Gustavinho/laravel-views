<?php

namespace LaravelViews\Http\Livewire;

use LivewireUI\Modal\ModalComponent;

class ModalAction extends ModalComponent
{
    public $modelClass;
    public $modelId;
    public $field;

    public function setModel($modelArray)
    {
        $this->modelClass = new $modelArray['class'];
        $this->modelId = $modelArray['id'];
    }

    public function getModelProperty()
    {
        return $this->modelClass->find($this->modelId);
    }
}
