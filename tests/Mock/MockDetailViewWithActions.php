<?php

namespace LaravelViews\Test\Mock;

use LaravelViews\Actions\RedirectAction;
use LaravelViews\Test\Mock\Actions\TestConfirmedAction;
use LaravelViews\Test\Mock\Actions\TestErrorAction;
use LaravelViews\Test\Mock\Actions\TestSuccessAction;

class MockDetailViewWithActions extends MockDetailView
{
    protected function actions()
    {
        return [
            new TestSuccessAction,
            new TestErrorAction,
            new TestConfirmedAction,
            new RedirectAction('user', 'See user', 'eye'),
            new RedirectAction('user.edit', 'Edit user', 'pencil'),
        ];
    }
}
