<?php

namespace LaravelViews\Views;

use LaravelViews\UI\Header;

abstract class TableView extends DataView
{
    public function getHeadersProperty()
    {
        foreach ($headers = $this->headers() as $key => $header) {
            if (!$header instanceof Header) {
                $headers[$key] = $header = (new Header)->title($header);
            }
        }

        return $headers;
    }

    public function render()
    {
        return view('laravel-views::table-view.table-view');
    }
}
