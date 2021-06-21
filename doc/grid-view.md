# Grid view

[See live example](https://laravelviews.com/grid-view)

This view creates a dynamic grid view using card data, same as a TableView this view has features like filters, pagination and a search input, you can also customize the card data as you need

- [Home](../README.md)
- [Grid view](#grid-view)
- [Create new grid view](#create-new-grid-view)
- [Defining initial data](#defining-initial-data)
- [Defining card data](#defining-card-data)
- [Customizing card data](#customizing-card-data)
- [Default card item action](#default-card-item-action)
- [Sorting Data](#sorting-data)
- [More features](#more-features)
  - [Searching data](./table-view.md#searching-data)
  - [Pagination](./table-view.md#pagination)
  - [Filters](./table-view.md#filters)
  - [Actions](./table-view.md#actions)

## Grid view example

![](./grid.png)

## Create new grid view

```bash
php artisan make:grid-view ExampleGridView
```

With this artisan command a `ExampleGridView.php` file will be created inside `app/Http/Livewire` directory, with this class you can customize the behavior of the grid view.

## Defining initial data

The GridView class needs a model class to get the initial data to be displayed on the table, you can define it in the `$model` property.

```php
use App\User;

protected $model = User::class;
```

If you need an specific query as initial data you can define a `repository` method  returning an `Eloquent` query with the initial data to be displayed on the grid view, it is important to return the query, not the data collection.

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

## Defining card data

You have to define a public function returning an array with the data that will be displayed on each card, this array has to include `photo`, `title`, `subtitle` and the `description`.

```php
public function card($item)
{
    return [
        'image' => $item->photo,
        'title' => $item->name,
        'subtitle' => $item->email,
        'description' => $item->description
    ];
}
```

These are the fields by default but you can add more if you want to customize your card.

## Customizing card data

The grid view has a card component by default with some data, however, you can create your own card component and use as much data as you need in the `card` method, you just need to specify a blade file with your Grid View and return the data that you need in the `card` method.

```php
public $cardComponent = 'components.my-card';

public function card($model) {
    return [
        'name' => $model->name,
        'email' => $model->email,
        'model' => $model
    ];
}
```

All the data returned in the `card` method will be received as a prop in your blade component alog with these other default props that you can use based on your needs.

Name|Description|Type|Value
--|--|--|--|
model|Model instance for this card|||
actions|Actions defined in this view class|Array
hasDefaultAction|Checks if the Grid View has defined a `onCardClick` method|Boolean|true,false
selected|Defines if the item was selected when the grid view has bulk actions|Boolean|true,false

With all this data you can build your own card component as you need, remember to include an `actions` component.

```html
<x-lv-actions :actions="$actions" :model="$model" />
<!-- Or -->
<x-lv-actions.drop-down :actions="$actions" :model="$model" />
```


## Default card item action
You can define a default action that will be fired clicking on the card image or the card title, this action gets the model instance that fired it.

```php
public function onCardClick(User $model)
{
}
```

## Max columns

The maximun number of colums by default is 5 for xl displays, you can customize this value with a public property.

```php
public $maxCols = 3;
```

## With background
The default card for each item doesn't have a background by default, you can customize this behavior with public property.

```php
public $withBackground = true
```

This will render the item with a white background.

## Sorting data
You can add an option to sort the items on the grid view by an specific field defining a `sortableBy` method with an array of the fields to sort by, as the grid view desn't have headers, a `Sort by` button will be displayed with a drop down with all the fields defined in this method.

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
This grid view is based on a table view, so you could use some of the table view features as:

- [Searching data](./table-view#searching-data)
- [Pagination](./table-view#pagination)
- [Filters](./table-view#filters)
- [Actions](./table-view#actions)
