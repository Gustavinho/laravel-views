# Table view

This view creates a dinamic data table, you can customize the headers, the data to be displayed for each row, add a search input, filters and actions

## Create new table view
```bash
php artisan make:table-view UsersTableView
```
With this artisan command a UsersTableView.php file will be created inside `app/Livewire` directory, this this class you can customize the behavior of the table view.

## Data repository
Return an `Eloquent` query with the initial data to be displayed on the table, it is important to return the query, not the data collection.
```php
use App\User;

public function repository(): Builder
{
    return User::query();
}
```

## Headers
Return an array with all the headers you need
```php
public function headers(): array
{
    return ['Name', 'Email' 'Created', 'Updated'];
}
```

## Rows
Return an array with all the data you need for each row, this method receives an model instance for every row in the database according with the initial query and the filters activated.
```php
public function row($model)
{
    return [$model->name, $model->email, $model->created_at, $model->updated_at];
}
```

## Searching data
You can enable a search input specifying a class property with the fields you want to search by
```php
public $searchBy = ['name', 'email'];
```
When this property is configured, a search input is showed at the top left of the table

## Pagination
The data is paginated by default showing 20 elements per page, you can customize this behavior with class property
```php
protected $paginate = 50;
```

