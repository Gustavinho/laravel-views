# Detail view

[See live example](http://laravel-views.herokuapp.com/detail-view)

This view creates a dynamic detail view to render a model attributes list with all the data you need, you can also customize the default component to create complex detail views and execute actions over the model is being used.

- [Home](../README.md)
- [Detail view](#detail-view)
- [Creating a new detail view](#creating-a-new-detail-view)
- [Defining initial model](#defining-initial-model)
- [Defining the heading](#defining-the-heading)
- [Defining the detail data](#defining-the-detail-data)
- [Customizing the default component](#customizing-the-default-component)
- [Using more components](#using-more-components)
- [Actions](#actions)

## Detail view example

![](./detail.png)

## Creating a new detail view

```bash
php artisan make:view detail ExampleDetailView
```

With this artisan command an `ExampleDetailView.php` file will be created inside the `app/Http/Livewire` directory, with this class you can customize the behavior of the detail view.

```php
<?php

namespace App\Http\Livewire;

use LaravelViews\Views\DetailView;

class ExampleDetailView extends DetailView
{
    public $title = "Title";
    public $subtitle = "Subtitle or description";

    /**
     * @param $model Model instance
     * @return Array Array with all the detail data or the components
     */
    public function detail($model)
    {
        return [
            'Name' => '',
            'Email' => '',
        ];
    }
}
```

## Defining initial model

The detail view uses a model instance as a data source, you have to set the model when you are rendering the component.

```html
<livewire:example-detail-view :model="$myModelInstance" />
```

You can set an `id` instead of a model instance, which will be created by the detail view. You must set a `$modelClass` property on your detail view to set the model class will be used to create the instance.

```html
<livewire:example-detail-view :model="1" />
```

```php
protected $modelClass = \App\User::class;
```

## Defining the heading

You can set a title and a subtitle to the detail view changing the value of the `$title` and `subtitle` as you need.

```php
public $title = "My custom title";
public $subtitle = "My custom subtitle";
```

If you need access to the model instance to set the title and subtitle, you can define a `heading` method returning an array with both values.

```php
public function heading($model)
{
    return [
        "This is the detail view of {$model->name}",
        "This is the subtitle of {$model->name}",
    ];
}
```

## Defining the detail data

The detail view will render an attributes list and will pass dynamically all the data defined in the `detail` method.
You have to define a public function returning an array with the data that will be sent to the attributes list.

```php
public function detail($model)
{
    return [
        'Name' => $model->name,
        'Email' => $model->email,
        // ...rest of the attributes
    ];
}
```

The default component will render an attributes list using an associative array to render the labels and the values.

Using this data array you can create simple detail views without any HTML code.


## Customizing the default component

If you dont want to use the default attributes list, you can create your own component and defining it in the `$detailComponent` property on your detail view class, all the data returned in the `detail` method will be passed as an attribute to your component.

```php
protected $detailComponent = 'components.my-attributes-list-component';

public function detail($model)
{
    return [
        'name' => $model->name,
        'email' => $model->email,
        // ...rest of the attributes
    ];
}
```

```html
<!-- resources/views/components/my-attributes-list-component -->
@props['name', 'email']
<ul>
  <li>Name: {{ $name }}<li/>
  <li>Eamil: {{ $email }}<li/>
</ul>
```

## Using more components
Some detail views can be complexer than a single attributes list, this detail view can render any other type of custom component as it is needed using the `UI` facade instead of a single data array.

```php
UI::component('components.my-custom-component', ['attribute' => 'value' ])
```

The `component` method of the `UI` class renders a blade component, the first argument is the component's path, and the second argument is an array with all the attributes that will be passed to the component.

```php
use LaravelViews\Facades\UI;

public function detail($model)
{
    return UI::component('components.my-custom-component', ['attribute' => 'value' ]);
}
```

You can set an array with more than one component, the detail view will iterate over it and will render all the components.

```php
use LaravelViews\Facades\UI;

public function detail($model)
{
    return [
      UI::component('components.my-custom-component', ['attribute' => 'value' ]),
      UI::component('components.my-second-component', ['model' => $model]),
      UI::attributes([
        'Name' => $model->name,
        'Email' => $model->email
      ])
    ];
}
```

The `attributes` method of the `UI` class is a pre-built component in this package, is the one used by default in de detail view.

Using customized components you can build detail views as complex as you need.


## Actions
The detail view can execute actions over the model is being used, the actions are defined in the `actions` method on the detail view and they have the same behavior as in the other views.

```php
public function actions()
{
    return [
        new ActivateUserAction,
        new RedirectAction('user', 'See user', 'eye'),
    ];
}
```

See the [full actions documentation](./table-view#actions)
