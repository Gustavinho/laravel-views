<?php

namespace LaravelViews\Views;

class GridView extends DataView
{
    /** Add a white background on each card */
    public $withBackground = false;

    public $gridStyles = 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-8 md:gap-8';

    public function collectionComponent()
    {
        return [
            'component' => 'laravel-views::grid',
            'attributes' => [
                'class' => $this->gridStyles
            ]
        ];
    }

    public function render()
    {
        return view('laravel-views::collection-view');
    }
}
