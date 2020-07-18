<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\RedirectAction;
use LaravelViews\Filters\Filter;

class MockTableViewWithRedirectActions extends MockTableView
{
    protected function actionsByRow()
    {
        return [
            new RedirectAction('user', 'See user', 'eye'),
            new RedirectAction('user.edit', 'Edit user', 'pencil'),
        ];
    }
}
