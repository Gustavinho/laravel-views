<?php

namespace LaravelViews\Test\Database;

use Illuminate\Database\Eloquent\Model;

class FoodTest extends Model
{
    protected $table = 'foods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'photo'
    ];
}
