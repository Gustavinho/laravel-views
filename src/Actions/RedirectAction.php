<?php

namespace LaravelViews\Actions;

class RedirectAction extends Action
{
    public $to;

    public function __construct(string $to, string $title, string $icon)
    {
        parent::__construct();

        $this->title = $title;
        $this->icon = $icon;
        $this->to = $to;

        // Overrides the original id to create different ids for each redirect action
        $this->id = $this->id . '-' . $this->to;
    }

    public function handle($item)
    {
        return redirect()->route($this->to, $item);
    }
}
