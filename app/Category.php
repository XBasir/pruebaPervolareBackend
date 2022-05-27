<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "categories";
    protected $fillable = [
        'code', 'title', 'description', 'idParentCategory', 'softDelete'
    ];

}