<?php

return [

    /**
     * Components variants customization
     */

    "buttons" => [
        "light" => "hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 active:bg-gray-100 active:text-gray-900",
        "primary" => "text-white bg-blue-600 hover:bg-blue-700 focus:ring-blue-500",
        "danger" => "text-white bg-red-600 hover:bg-red-700 focus:ring-red-500",
        "white" => "hover:bg-gray-100 focus:ring-gray-200 border border-gray-400",
        "primary-light" => "text-blue-700 border border-blue-600 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white active:bg-blue-600 active:text-white",
    ],

    "alerts" => [
        "success" => [
            "base" => "bg-green-100 border-green-300 text-green-700",
            "icon" => "bg-green-200",
            "title" => "text-green-900",
        ],
        "danger" => [
            "base" => "bg-red-100 border-red-300 text-red-700",
            "icon" => "bg-red-200",
            "title" => "text-red-900",
        ],
        "warning" => [
            "base" => "bg-green-100 border-green-300 text-green-700",
            "icon" => "bg-green-200",
            "title" => "text-green-900",
        ]
    ],

    "badges" => [
        'success' => 'bg-green-200 text-green-800',
        'danger' => 'bg-red-200 text-red-800',
        'warning' => 'bg-yellow-200 text-yellow-800',
        'info' => 'bg-blue-200 text-blue-800',
        'default' => 'bg-gray-200 text-gray-800'
    ],

    "images" => [
        'avatar' => 'h-8 w-8 object-cover rounded-full shadow-inner'
    ],

    "icons" => [
        'success' => 'text-green-500',
        'danger' => 'text-red-500',
        'warning' => 'text-yellow-500',
        'info' => 'text-blue-500',
    ],

    'links' => [
        'default' => 'hover:text-blue-600 hover:underline'
    ],

    'gridView' => [
        'selected' => 'border-2 border-blue-500'
    ],

    'components' => [
        'layout' => 'lv-layout',
        'alerts-handler' => 'lv-alerts-handler',
        'alert' => 'lv-alert',
        'confirmation-message' => 'laravel-views::confirmation-message',
        'modal' => 'lv-modal',
        'dropdown' => 'lv-drop-down',
        'actions' => 'lv-actions',
        'action-desktop' => 'laravel-views::actions.action-desktop',
        'action-mobile' => 'laravel-views::actions.action-mobile',
        'icon-button' => 'lv-icon-button',
        'icon-text-button' => 'laravel-views::buttons.icon-and-text',
        'toolbar' => 'laravel-views::toolbar.toolbar',
        'toolbar-search' => 'laravel-views::toolbar.search',
        'toolbar-bulk' => 'laravel-views::toolbar.bulk-actions',
        'toolbar-sorting' => 'laravel-views::toolbar.sorting',
        'toolbar-filters' => 'laravel-views::toolbar.filters',
        'heading' => 'laravel-views::heading',
        'checkbox' => 'laravel-views::form.checkbox',
        'table' => 'laravel-views::table',
        'table-cell' => 'laravel-views::table-cell',
        'table-cell-header' => 'laravel-views::table-cell-header',
        'grid-view-item' => 'laravel-views::grid-view-item',
    ],
];
