<?php

namespace LaravelViews\Test\Mock\Actions;

use LaravelViews\Actions\Action;

class TestErrorAction extends Action
{
    public function handle($model)
    {
        $this->error();
    }
}
