<?php

namespace LaravelViews\Actions;

trait Confirmable
{
    public function getConfirmationMessage($item = null)
    {
        return __('Do you really want to perform this action?');
    }
}
