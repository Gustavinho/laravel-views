![Laravel views](https://laravelviews.com/img/docs/table.png)

# Laravel views

Laravel package to create beautiful common views like data tables using the [TALL stack](https://tallstack.dev/).

# Documentation
Read the [full documentation](https://laravelviews.com)

# Live examples
See some [live examples](https://laravelviews.com/examples/table-view) for the different views.

## Contributing

Check the [contribution guide](CONTRIBUTING.md)

## Roadmap

Laravel Views is still under heavy development so I will be adding more awesome features and views.

Here's the plan for what's coming:

- **New form view**
- **New layout view**
- Add a download action
- Add translations
- Add links as a UI helpers

## Upgrade guide
### From 2.4.0 to 2.4.1
**Publish blade componentes**

Some of the internal components have changed, if you have published these components before to customize them, you will not have them up to date, unfourtunately you need to publish them again with `php artisan vendor:publish --tag=views --provider='LaravelViews\LaravelViewsServiceProvider'` and customize them as you need.

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
