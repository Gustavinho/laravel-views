# Grid view

This view creates a dynamic grid view using card data, same as a TableView this view has features like filters, pagination and a search input, you can also customize the card data as you need

- [Laravel views](../README.md)
- [Grid view](#grid-view)
  - [Create new grid view](#create-new-grid-view)
  - [Defining initial data](#defining-initial-data)
  - [Defining card data](#defining-card-data)
  - [Customizing card data](#customizing-card-data)
  - [More features](#more-features)

## Grid view example

![](./grid.png)

## Create new table view

```bash
php artisan make:grid-view ExampleGridView
```

With this artisan command a `ExampleGridView.php` file will be created inside `app/Http/Livewire` directory, with this class you can customize the behavior of the grid view.

## Defining initial data

Return an `Eloquent` query with the initial data to be displayed on the grid view, it is important to return the query, not the data collection.

```php
use App\User;

public function repository(): Builder
{
    return User::query();
}
```

## Defining card data

You have to define a public function returning an array with the data which will be displayed on each card, this array has to include `photo`, `title`, `subtitle` and the `description`.

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

The grid view has a card component by default with some data but you can either create your own card and use as much data as you need in the `card` mthod and just use your own card implementation, you just need to specify a blade file.

```php
public $cardComponent = 'components.my-card';
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

## More features
This grid view is based on a table view, so you could use some of the table view features as:

- [Searching data](./table-view#searching-data)
- [Pagination](./table-view#pagination)
- [Filters](./table-view#filters)
- [Actions](./table-view#actions)
