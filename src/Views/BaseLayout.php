<?php

namespace Gustavinho\LaravelViews\Views;

class BaseLayout
{
    private $content;

    public function __construct($data)
    {
        $this->data = array_merge(
            $this->data(),
            $data
        );
    }

    public function render()
    {
        $data = $this->data;
        $data['content'] = $this->content;

        return view($this->layout, $data);
    }

    public function with($view)
    {
        $this->content = admin($view);

        return $this;
    }
}
