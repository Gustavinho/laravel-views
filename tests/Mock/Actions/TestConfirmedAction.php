<?php

namespace LaravelViews\Test\Mock\Actions;

use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;

class TestConfirmedAction extends Action
{
    use Confirmable;

    public function handle($model)
    {
        $this->success();
    }
}
