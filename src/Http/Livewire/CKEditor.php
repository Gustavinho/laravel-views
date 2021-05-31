<?php

namespace LaravelViews\Http\Livewire;


class CKEditor extends ModalAction
{
    public $value;

    public function mount($model, $field = 'name')
    {
        $this->setModel($model);
        $this->field = $field;
        $this->value = $this->model->$field;
    }

    public function update()
    {
        $field = $this->field;
        $this->model->$field = $this->value;
        $this->model->save();
        $this->emit('refreshView');
        $this->closeModal();
    }

    public function render()
    {
        return view('laravel-views::livewire.ckeditor');
    }
}