<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * mass assignable attributes
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'author_id'
    ];
}
