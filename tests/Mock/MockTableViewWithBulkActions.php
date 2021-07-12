<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Test\Mock\Actions\TestConfirmedAction;
use LaravelViews\Test\Mock\Actions\TestConfirmedDeleteUsersAction;
use LaravelViews\Test\Mock\Actions\TestDeleteUsersAction;
use LaravelViews\Test\Mock\Actions\TestErrorAction;
use LaravelViews\Test\Mock\Actions\TestSuccessAction;

class MockTableViewWithBulkActions extends MockTableView
{
    public function bulkActions()
    {
        return [
            new TestDeleteUsersAction,
            new TestSuccessAction,
            new TestErrorAction,
            new TestConfirmedDeleteUsersAction,
            new RedirectAction('user', 'See user', 'eye'),
            new RedirectAction('user.edit', 'Edit user', 'pencil'),
        ];
    }
}
