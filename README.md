# Laravel views

Laravel package to create beautiful common views like tables using only PHP code, these views are built with [Laravel livewire](https://laravel-livewire.com/) and styled using [Tailwind css](https://tailwindcss.com/)

## Table view example
![](doc/table.png)

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
php artisan vendor:publish --tag=public --provider='Gustavinho\LaravelViews\LaravelViewsServiceProvider' --force
```

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
These blade directives are also including [Laravel livewire](https://laravel-livewire.com/) styles and scripts, after that maybe you will need to clear the view cache
```bash
php artisan view:clear
```

## First table view
Once you have installed the package and included the assets you can start to create a basic table view.
```bash
php artisan make:table-view UsersTableView
```
With this artisan command a UsersTableView.php file will be created inside `app/Views` with this content
```php
<?php

namespace App\Views;

use Gustavinho\LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;

class UsersTableView extends TableView
{
    public function repository(): Builder
    {
    }

    public function headers(): array
    {
        return [];
    }

    public function row($model)
    {
        return [];
    }
}

```
With this class you can customize the behavior of your table view.

## Rendering the table view
The easiest way to render the view is directly in a blade file
```blade
{!! LaravelViews::create(App\Views\UsersTableView::class)->render !!}
```

But also you can inject a `LaravelViews` instance as a dependency in your controller
```php
public function index(LaravelViews $laravelViews)
{
    $laravelViews->create(App\Views\UsersTableView::class);

    return view('my-view', [
      'view' => $laravelViews
    ]);
}
```
Then in your blade file
```blade
{!! $view->render() !!}
```
At this point you would be able to see a empty table view

## Adding data

The basic usage needs a data repository (Eloquent query), headers and rows, try adding some data like this example
```php
<?php

namespace DummyNamespace;

use Gustavinho\LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class DummyClass extends TableView
{
    public function repository(): Builder
    {
        return User::query();
    }

    public function headers(): array
    {
        return [
          'Name',
          'Email'
          'Created',
          'Updated'
        ];
    }

    public function row($model)
    {
        return [
            $model->name,
            $model->email,
            $model->created_at,
            $model->updated_at
        ];
    }
}

```
In the exaple above the view is using the User model created by default in every Laravel project, feel free to use any model you have, the method `row` is receiving a sinlge model object and you can use any property or public method you have difined inside your model

This is the basic usage of the table view, but you can customize it with more features.

See a site demo here



php artisan make:filter Views/CivilAssociations/ActiveFilter

php artisan vendor:publish --tag=public --force