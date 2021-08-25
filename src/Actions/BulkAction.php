<?php

namespace LaravelViews\Actions;

use Illuminate\Contracts\View\View as ViewContract;
use LaravelViews\Actions\Action as Action;

abstract class BulkAction extends Action
{
    public function render(): ViewContract
    {
        return view('laravel-views::actions.action-bulk');
    }
}
