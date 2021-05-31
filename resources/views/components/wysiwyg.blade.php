{{-- components.wysiwyg

Render open a modal to edit with CKEditor

--}}

<div onclick="Livewire.emit('openModal', 'laravel-views-ckeditor', {{ json_encode(['model' => ['id' => $model->id, 'class' => get_class($model)], 'field' => $field]) }})"
        class='transition-all duration-300 ease-in-out inline-block cursor-pointer border-b-2 border-dotted border-gray-400 hover:bg-gray-100 p-1'>
    {!! $model->$field !!}
</div>