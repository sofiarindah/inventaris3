<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [

        'category_id',

        'name',

        'photo',

        'unique_code',

        'condition',

        'location',

        'user_id',

    ];



    // Mendefinisikan relasi "belongsTo" ke model Category

    public function category()

    {

        return $this->belongsTo(Category::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}