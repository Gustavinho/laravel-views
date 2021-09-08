<?php

namespace LaravelViews\Actions;

use LaravelViews\Actions\Action as Action;

abstract class BulkAction extends Action
{
    /**
     * Get the blade component that will be used for this object.
     *
     * @return string
     */
    public function component()
    {
        return 'laravel-views::actions.action-bulk';
    }
}
