<?php

return [

    /**
     * Components variants customization
     */

    "buttons" => [
        "light" => "hover:bg-gray-100 hover:text-gray-900 focus:bg-gray-100 focus:text-gray-900 active:bg-gray-100 active:text-gray-900",
        "primary" => "text-white bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-500",
        "primary-light" => "text-blue-700 border border-blue-600 hover:bg-blue-600 hover:text-white focus:bg-blue-600 focus:text-white active:bg-blue-600 active:text-white",
        "danger" => "text-white bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-500",
    ],

    "paginator" => [
        "primary" => "bg-blue-600 border-blue-600"
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
    ]
];
