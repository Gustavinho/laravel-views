<?php

namespace LaravelViews\Views;

use LaravelViews\UI\Header;

abstract class TableView extends DataView
{
    /** Component name */
    protected $view = 'table-view.table-view';

    public function getHeadersProperty()
    {
        foreach ($headers = $this->headers() as $key => $header) {
            if (!$header instanceof Header) {
                $headers[$key] = $header = (new Header)->title($header);
            }

            $header->view = $this;
        }

        return $headers;
    }
}
