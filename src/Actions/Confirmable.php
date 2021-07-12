<?php

namespace LaravelViews\Actions;

trait Confirmable
{
    /**
     * Model instance who fired the action, it is null if it
     * was a bulk action
     */
    public function getConfirmationMessage($model = null)
    {
        return __('Do you really want to perform this action?');
    }
}
