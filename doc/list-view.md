# List view

[See live example](https://laravelviews.com/list-view)

This view creates a dynamic list view with filters, pagination, search input, and actions by each item, it is useful for small screens, you can also customize the item compoment for each row as you need.

- [Home](../README.md)
- [List view](#list-view)
- [Creating a new list view](#creating-a-new-list-view)
- [Defining initial data](#defining-initial-data)
- [Defining data for each list item](#defining-data-for-each-list-item)
- [Customizing the list item component](#customizing-the-list-item-component)
- [Sorting Data](#sorting-data)
- [More features](#more-features)
  - [Searching data](./table-view.md#searching-data)
  - [Pagination](./table-view.md#pagination)
  - [Filters](./table-view.md#filters)
  - [Actions](./table-view.md#actions)

## List view example

![](./list.png)

## Creating a new list view

```bash
php artisan make:list-view ExampleListView
```

With this artisan command an `ExampleListView.php` file will be created inside the `app/Http/Livewire` directory, with this class you can customize the behavior of the list view.

## Defining initial data

The ListView class needs a model class to get the initial data to be displayed on the table, you can define it in the `$model` property.

```php
use App\User;

protected $model = User::class;
```

If you need an specific query as initial data you can define a `repository` method  returning an `Eloquent` query with the initial data to be displayed on the list view, it is important to return the query, not the data collection.

```php
use App\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * Sets a initial query with the data to fill the table
 *
 * @return Builder Eloquent query
 */
public function repository(): Builder
{
    return User::query();
}
```
If you define this method, the `$model` property is not needed anymore.

## Defining data for each list item

The list view will render a blade component and will pass dynamically its properties, those properties need to be defined in the `data` method.
You have to define a public function returning an array with the data that will be sent to every list item, the default component needs the `avatar`, `title`, and the `subtitle`.

```php
public function data($model)
{
    return [
        'avatar' => '',
        'title' => '',
        'subtitle' => '',
    ];
}
```

These are the fields by default but you can add more if you want to customize your list item component.

## Customizing the list item component

The list view uses its own blade component by default with some data but you can create your own list item component and use as much data as you need, you just need to set a public property with the name of your custom component. If you need different properties in your component just return them in the `data` method.

The customized component will allways get two properties by default, `actions` and `model`, *actions* is an array with all the actions defined in the list view class, and *model* is an instance of the current model for that list item.

```php
public $itemComponent = 'components.my-custom-list-item-component';

public function data($model)
{
    return [
      // ... all the component's properties
    ];
}
```

```html
<!-- File resources/views/components/my-custom-list-item-component.blade.php -->
@props(['actions', 'model'])

<div>
  <p>My custom content for each list item</p>
</div>
```

Don't forget to include the actions for each list item, there is a component out of the box to render those action buttons.
```html
<!-- File resources/views/components/my-custom-list-item-component.blade.php -->
@props(['actions', 'model'])

<div>
  <p>My custom content for each list item</p>
  <x-lv-actions :actions="$actions" :model="$model" />
</div>
```

## Sorting Data
You can provide your list view with a sorting drop down by overriding the sortablyBy function on your list view. You may assign the $sortBy property to choose the column that the list view is sorted by when the page first loads.

```php
public $sortBy = 'name';

public function sortableBy()
    {
        return [
            'Name' => 'name',
            'Email' => 'email'
        ];
    }
```

## Sorting data
You can add an option to sort the items on the list view by an specific field defining a `sortableBy` method with an array of the fields to sort by, as the list view desn't have headers, a `Sort by` button will be displayed with a drop down with all the fields defined in this method.

```php
public function sortableBy()
{
    return [
        'Name' => 'name',
        'Email' => 'email'
    ];
}
```

## More features
This list view is based on a table view, so you could use some of the table view features as:

- [Searching data](./table-view#searching-data)
- [Pagination](./table-view#pagination)
- [Filters](./table-view#filters)
- [Actions](./table-view#actions)
