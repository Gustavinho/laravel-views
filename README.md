# Laravel views

[See live example](https://laravelviews.com)

Laravel package to create beautiful common views like tables using only PHP code, inspired by [Laravel Nova](https://nova.laravel.com/), these views are built with [Laravel Livewire](https://laravel-livewire.com/) and styled using [Tailwind CSS](https://tailwindcss.com/)

## Table View example

![](doc/laravel-views.png)

- [Version compatibility](#version-compatibility)
- [Upgrade guide](#upgrade-guide)
- [Installation and basic usage](#installation-and-basic-usage)
  - [Installing laravel views](#installing-laravel-views)
  - [Publishing assets](#publishing-assets)
  - [Including assets](#including-assets)
- [First table view](#first-table-view)
  - [Rendering the table view](#rendering-the-table-view)
- [Rendering a view](#rendering-a-view)
- [Advanced usage](doc/laravel-views.md)
- [Views available](#views-available)
  - [Table view](#table-view)
  - [Grid view](#grid-view)
  - [List view](#list-view)
  - [Detail view](#detail-view)
- [Contributing](#contributing)
- [Roadmap](#roadmap)

# Version compatibility
|Laravel views|Alpine|Livewire|Laravel|
|-|-|-|-|
|2.x|2.8.x, 3.x.x|2.x|7.x, 8.x|
|1.x|2.8.x|1.x|5.x, 6.x|

# Installation and basic usage

## Installing laravel views
```bash
composer require laravel-views/laravel-views
```

## Publishing assets
```bash
php artisan vendor:publish --tag=public --provider='LaravelViews\LaravelViewsServiceProvider' --force
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

Laravel Views includes by default a set up using different parts of the TALL stack assets like the [Laravel livewire](https://laravel-livewire.com/) and [Tailwindcss](https://tailwindcss.com/) styles and scripts, it alsoincludes the [Alpine.js](https://laravel-livewire.com/docs/2.x/alpine-js) script, after adding these directives you may need to clear the view cache

```bash
php artisan view:clear
```

These directives are fine for a dev environment, however, if you want to use your own Tailwindcss or Alpinde.js setup, you can [disable these assets](./doc/laravel-views.md#including-assets) from being loaded with the Laravel views directive.
# First table view
This is a basic usage of a table view, you can [read the full table view documentation ](doc/table-view.md)


Once you have installed the package and included the assets you can start to create a basic table view.
```bash
php artisan make:table-view UsersTableView
```
With this artisan command a UsersTableView.php file will be created inside the `app/Http/Livewire` directory.

The basic usage needs a model class, headers and rows, you can customize the items to be shown, and the headers and data for each row like this example
```php
<?php

namespace App\Http\Livewire;

use LaravelViews\Views\TableView;
use Illuminate\Database\Eloquent\Builder;
use App\User;

class UsersTableView extends TableView
{
    protected $model = User::class;

    public function headers(): array
    {
        return [
            'Name',
            'Email',
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

In the example above the view is using the User model created by default in every Laravel project, feel free to use any model you want, the method `row` is receiving a sinlge model object and you can use any property or public method you have difined inside your model.

This is the basic usage of the table view, but you can customize it with more features.

[Read the full table view documentation ](doc/table-view.md)

## Advanced usage

[Read the advanced laravel-views documentation ](doc/laravel-views.md)

## Views available
### [Table view](doc/table-view.md)

Dynamic data table with some features like filters, pagination and search input, you can customize the headers, the data to be displayed for each row

![](doc/table.png)

### [Grid view](doc/grid-view.md)

Dynamic grid view using card data, same as a TableView this view has features like filters, pagination and a search input, you can also customize the card data as you need

![](doc/grid.png)

### [List view](doc/list-view.md)

Dynamic list view with filters, pagination, search input, and actions by each item, it is useful for small screens, you can also customize the item compoment for each row as you need.

![](doc/list.png)

### [Detail view](doc/detail-view.md)
Dynamic detail view to render a model attributes list with all the data you need, you can also customize the default component to create complex detail views and execute actions over the model is being used.

![](doc/detail.png)

## Contributing

Check the [contribution guide](CONTRIBUTING.md)

## Roadmap

Laravel Views is still under heavy development so I will be adding more awesome features and views.

Here's the plan for what's coming:

- **New form view**
- **New layout view**
- Add tooltips to actions buttons
- Add a download action
- Add translations
- Add links as a UI helpers

## Upgrade guide
### From 2.2 to 2.3
**Cached views**

The blade directives have changed, you need to clear the cached views with `php artisan view:clear`

**Public assets**

The main assets (JS and CSS files) have changed, you need to publish the public assets again with `php artisan vendor:publish --tag=public --provider='LaravelViews\LaravelViewsServiceProvider' --force`

**Publish blade componentes**

Some of the internal components have changed, if you have published these components before to customize them, you will not have them up to date, unfourtunately you need to publish them again with `php artisan vendor:publish --tag=views --provider='LaravelViews\LaravelViewsServiceProvider'` and customize them as you need.

**Method `renderIf()` in actions**

Update the renderIf() function in your action classes adding a new `$view` parameter as follows:
  ```php
  <?php

  namespace App\Actions;

  use LaravelViews\Actions\Action;
  use LaravelViews\Views\View;          // new line

  class YourAction extends Action
  {
      public function renderIf($item, View $view)       // add the view parameter
      {
          // your content
      }
  }
  ```
**Publish config file (Optional)**

Some new variants have been added to the config file, if you have published the config file before, you could publish it again so you can customize the new variants, this doesn't affect anything at all since the new variants will be taken from the default config file.

**Remove `repository` method from your views (Optional)**

If your `repository()` methods are returning a query object without any other query applied like `User::query()`, you can define a `protected $model = User::class;` instead, this is the default behavior now, the `repository()` method is still working so you don't need to change anything if you don't want to.

```php
/* Before */
public function repository(): Builder
{
    // You are using a single query
    return User::query();
}

/** After */
protected $model = User::class;
```
