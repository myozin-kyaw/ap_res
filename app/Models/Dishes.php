<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dishes extends Model
{
    use HasFactory;
    // protected $fillable = ['name','category','dish_image'];
    protected $guarded = [];

    public function category() 
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
