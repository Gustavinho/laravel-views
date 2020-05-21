<?php

namespace Gustavinho\LaravelViews\Actions;

class RedirectAction extends Action
{
    public $to;

    public function __construct(string $to, string $title, string $icon)
    {
        parent::__construct();

        $this->title = $title;
        $this->icon = $icon;
        $this->to = $to;
    }

    public function handle($item)
    {
    }
}
