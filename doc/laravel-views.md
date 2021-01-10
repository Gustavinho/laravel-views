# Laravel views

- [Home](../README.md)
- [Installation and basic usage](#installation-and-basic-usage)
    - [Installing laravel views](#installing-laravel-views)
    - [Publishing assets](#publishing-assets)
    - [Including assets](#including-assets)
    - [Purge Tailwindcss styles](#purge-tailwindcss-styles)
- [First table view](#first-table-view)
    - [Rendering the table view](#rendering-the-table-view)
- [Rendering a view](#rendering-a-view)
    - [From a controller](#from-a-controller)
    - [Specifying a layout and section](#specifying-a-layout-and-section)
    - [Send extra data](send-extra-data)
- [Components customization](#components-customization)
    - [Component variants using tailwindcss](#component-variants-using-tailwindcss)
    - [Components full customization](#components-full-customization)
- [Table view](doc/table-view.md)
- [Grid view](doc/grid-view.md)

# Version compatibility
|Laravel views|Livewire|Laravel|
|-|-|-|
|2.x|2.x|7.x, 8.x|
|1.x|1.x|5.x, 6.x|

# Installation and basic usage

## Installing laravel views
```bash
composer require laravel-views/laravel-views
```

## Publishing assets
```bash
php artisan vendor:publish --tag=public --force
```
or you can specify the provider
```bash
php artisan vendor:publish --tag=public --provider='LaravelViews\LaravelViewsServiceProvider' --force
```

If you are updating this package you might need to republish these assets.

## Including assets
Add the following Blade directives in the *head* tag, and before the end *body* tag in your template

```blade
<html>
<head>
  ...
  @laravelViewsStyles
</head>
<body>
  ...
  @laravelViewsScripts
</body>
</html>
```

These blade directives are also including [Laravel livewire](https://laravel-livewire.com/) and [Tailwindcss](https://tailwindcss.com/) styles and scripts, after that you may need to clear the view cache
```bash
php artisan view:clear
```

You can specify which assets you want to include passing a string to those directives with a list of the assets you want to include.

```php
@laravelViewsStyles(laravel-views,tailwindcss,livewire)
```

If you dont need to include `Tailwindcss` or `Livewire` assets you can just set the `laravel-views` assets in the list.

```php
@laravelViewsStyles(laravel-views)
```

## Purge Tailwindcss styles
If you're using your own Tailwindcss setup you must consider `laravel-views` in your `purge` configuration, for that just add this path to the `purge` array on the `tailwind.config.js`file.

```js
purge: {
  content: [
    //...Rest of your paths
    "./vendor/laravel-views/**/*.php",
  ],
},
```

# First table view
This is a basic usage of a table view, you can [read the full table view documentation ](doc/table-view.md)


Once you have installed the package and included the assets you can start to create a basic table view.
```bash
php artisan make:table-view UsersTableView
```
With this artisan command a UsersTableView.php file will be created inside `app/Http/Livewire` directory.

The basic usage needs a data repository (Eloquent query), headers and rows, you can customize the items to be shown, and the headers and data for each row like this example
```php
<?php

namespace App\Http\Livewire;

use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class UsersTableView extends TableView
{
    public function repository(): Builder
    {
        return User::query();
    }

    public function headers(): array
    {
        return ['Name', 'Email', 'Created', 'Updated'];
    }

    public function row($model)
    {
        return [$model->name, $model->email, $model->created_at, $model->updated_at];
    }
}
```

## Rendering the table view
You can render this view in the same way as you would do it for a livewire component ([Rendering components](https://laravel-livewire.com/docs/2.x/rendering-components)).
The easiest way to render the view is using the livewire tag syntax:
```blade
<livewire:users-table-view />
```

You could also use the `@livewire` blade directive.
```blade
@livewire('users-table-view')
```

At this point, you would be able to see a table with some data, the table view doesn't have any styled container or title as the image example, you can render the table view inside any container you want.

In the example above the view is using the User model created by default in every Laravel project, feel free to use any model you have, the method `row` is receiving a sinlge model object and you can use any property or public method you have difined inside your model.

This is the basic usage of the table view, but you can customize it with more features.

[Read the full table view documentation ](doc/table-view.md)

# Rendering a view from a controller

You can render a view manually in a controller creating a `LaravelViews` instance and executing the `render` method on a `blade` file.

```php
use use LaravelViews\LaravelViews;

public function index(LaravelViews $laravelViews)
{
    $laravelViews->create(App\Http\Livewire\UsersTableView::class);

    return view('my-view', [
      'view' => $laravelViews
    ]);
}
```
And render it in your blade file
```blade
{!! $view->render() !!}
```

## Specifying a layout and section
You can also return the view directly from your controller and specify the layout and section of your layout
```php
use use LaravelViews\LaravelViews;

public function index(LaravelViews $laravelViews)
{
    $laravelViews->create(App\Http\Livewire\UsersTableView::class)
      ->layout('layout', 'section-name');

    return $laravelViews->render();
}
```

## Send extra data to the layout
In the same way that you would send data to your views, you can send more data to the layout file
```php
use use LaravelViews\LaravelViews;

public function index(LaravelViews $laravelViews)
{
    $laravelViews->create(App\Http\Livewire\UsersTableView::class)
      ->layout('layout', 'section-name', [
        'title' => 'My layout title'
      ]);

    return $laravelViews->render();
}
```

# Components customization
These views are build with [Tailwind CSS](https://tailwindcss.com/) and you can either change the colors of the components following tailwindcss utilities or fully customize all the html of the components

## Component variants using tailwindcss
If you are using [Tailwind CSS](https://tailwindcss.com/) or if you don't have issues  using Tailwindcss and your own css styles, you can customize some utilities to change the color for each variant of the components publishing a config file

```bash
php artisan vendor:publish --tag=config
```
or you can specify the provider
```bash
php artisan vendor:publish --tag=config --provider='LaravelViews\LaravelViewsServiceProvider'
```

Inside this config file you can change the colors for each component variant. If you are updating this package you might need to republish this config file.

## Components full customization

If you are not using taildwindcss, or if you want to have a full customization over the html components, you can publish all the blade files used for these views.

```bash
php artisan vendor:publish --tag=views
```
or you can specify the provider
```bash
php artisan vendor:publish --tag=views --provider='LaravelViews\LaravelViewsServiceProvider'
```

If you are updating this package you might need to republish these views.