<?php

namespace LaravelViews\Test\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewTest extends Model
{
    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'food_id', 'user_id', 'message'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(UserTest::class, 'user_id', 'id');
    }

    public function food(): BelongsTo
    {
        return $this->belongsTo(FoodTest::class, 'food_id', 'id');
    }
}
